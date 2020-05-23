//jquery
//bootstrap
//react

class Navigation extends React.Component {
	render(){
		
		const goToLesson = this.props.goToLesson
		const progress = this.props.progress
		let userProps = '';

		for (let [key, value] of Object.entries(this.props.student)) {
			userProps += " " + `<i>${key}</i>: ${value}`;
		}

		return (
		<aside className={this.props.size}>

	    	<h2>{this.props.course.title}</h2>

			<div className="progress" style={{height: "15px", margin:"15px"}}>
			  <div className="progress-bar bg-primary progress-bar-striped" role="progressbar" style={{width: progress + "%" }} aria-valuenow={progress} aria-valuemin="0" aria-valuemax="100">{progress}%</div>
			</div>

	    	<ol>
	    		{this.props.course && this.props.course.lessons.map(function(lesson, index){
	    			return <li key={index} ><a href="#" onClick={goToLesson} data-index={index}>{lesson.title}</a></li>
	    		})}
	    	</ol>

	    	(<p dangerouslySetInnerHTML={{__html: userProps}} />)
	    </aside>);
	}
}

class Activity extends React.Component {
	render(){

		switch(this.props.activity.type){

			case 'ddd':
				return (<div/>);
				break;

			default:

			    return (
				<div dangerouslySetInnerHTML={{__html: this.props.activity.value}} />
				);
		}

	}

}

class App extends React.Component {

	constructor(){
		super();
		this.state = {
			course: false,
			currentLesson: 0,
			currentActivity: 0,
			student: {
				name:"me",
				email:"m4@aol.com"
			}
		}
	}

	componentDidMount(){
		this.getCourseInfo()
	}

	getCourseInfo(){
		let setState = this.setState.bind(this)

		$.get( "/course/index.json", function( data ) {
			setState({course: data})
		}, "json" );
	}

	goToLesson(e){
		e.preventDefault()
		this.setState({currentLesson: parseInt(e.target.dataset.index), currentActivity: 0})
	}

	nextActivity(e){
		this.setState({currentActivity: parseInt(this.state.currentActivity)+1})
	}

	updateStudent(e){
		const label = e.target.dataset.label
		let state = {...this.state }
		if(!state.student){state.student = {};}
		state.student[label] = e.target.value
		this.setState(state)
		
	}

	userIsSignedIn(){
		const state = this.state
		let test = true

		if(!state.course){return false;}

		state.course.need_from_user.map(function(label){
			if(!state.student[label]){
				test = false;
			}else{
				if(label === 'email' && !state.student.email.includes('@') ){
					test = false;
				}else if(label === 'email' && !state.student.email.includes('.') ){
					test = false;
				}else if(label === 'email' && state.student.email.length <= 8 ){
					test = false
				}
			}
		})

		return test;
	}

	courseIsComplete(){

		if(this.state.course){
			if(this.state.course.lessons.length <= this.state.currentLesson){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	render(){

		const goToLesson = this.goToLesson.bind(this)
		const updateStudent = this.updateStudent.bind(this)

	if(!this.userIsSignedIn() && this.state.course){

		return (<div className="container d-flex align-items-center" style={{height:"100%"}}>
			<div className="row justify-content-center">
				<main className="col-md-6">
					<h2>Please enter your information below to begin "{this.state.course.title}":</h2>

					<form>
					{this.state.course.need_from_user.map(function(label, k){

						return (<div key={k} className="form-group">
					    <label htmlFor="formGroupExampleInput">{label}</label>
					    <input data-label={label} onBlur={updateStudent} type="text" className="form-control" id="formGroupExampleInput" placeholder={label} />
					  </div>);

					})}
					</form>
					
				</main>
			</div>
		</div>);

	}else if(this.courseIsComplete()){
		return (<div className="container d-flex align-items-center">
			<div className="row justify-content-center">
				<div className="col-md-8">
					<div dangerouslySetInnerHTML={{__html: this.state.course.end}} />
				</div>
				<Navigation size={"col-md-4"} course={this.state.course} goToLesson={this.goToLesson.bind(this)} student={this.state.student} progress={100}/>
			</div>
		</div>
		)
	}else{

		const progress = this.state.course? 100 * ((this.state.currentLesson+1)/this.state.course.lessons.length) : 100
		const lessonProgress = this.state.course && this.state.course.lessons[this.state.currentLesson].activities.length > 0? 100 * ((this.state.currentActivity+1)/this.state.course.lessons[this.state.currentLesson].activities.length) : 100
		let congratulations = null
		let nextActivityButton = null

		if(this.state.course && this.state.course.lessons[this.state.currentLesson]){
			if(lessonProgress !== 100){
				nextActivityButton = <button className="btn btn-success" onClick={this.nextActivity.bind(this)} >next activity</button>
			}else{
				const nLesson = this.state.currentLesson+1
				if (nLesson <= this.state.course.lessons.length+1){
					nextActivityButton = <button className="btn btn-primary" onClick={goToLesson} data-index={nLesson} >next lesson</button>
				}
			}
		}

	return (
		<div className="container">
			<div className="row">

				<main className="col-md-8">

					<div className="progress" style={{height: "50px", marginBottom:"30px"}}>
					  <div className="progress-bar bg-success progress-bar-striped" role="progressbar" style={{width: lessonProgress + "%" }} aria-valuenow={lessonProgress} aria-valuemin="0" aria-valuemax="100">{lessonProgress}% of Lesson</div>
					</div>

			  		<h1>{this.state.course && this.state.course.lessons[this.state.currentLesson].title}</h1>

			  		{this.state.course && this.state.course.lessons[this.state.currentLesson].activities[this.state.currentActivity] && <Activity activity={this.state.course.lessons[this.state.currentLesson].activities[this.state.currentActivity]}/>}

			  		{nextActivityButton}
			  		
			    </main>

			    {this.state.course && <Navigation size={"col-md-4"} course={this.state.course} goToLesson={this.goToLesson.bind(this)} student={this.state.student} progress={progress}/>}

			</div>
		  </div>
		);
	  }
	}
}

ReactDOM.render(
  <App/>,
  document.getElementById('root')
);