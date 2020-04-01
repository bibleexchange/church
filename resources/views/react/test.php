<html>
  <head>
    <title>Hello React</title>
    <script src="https://fb.me/react-0.13.2.js"></script>
    <script src="https://fb.me/JSXTransformer-0.13.2.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>
  </head>
  <body>
    
    <div id="study-comments"></div>
    <script type="text/jsx">

var Avatar = React.createClass({
	
	getDefaultProps: function(){

		return {
				
			<?php 
			
			if($currentUser){
			
				echo '
    			avatar_path: "' .  $currentUser->present()->gravatar(30) . '",
				avatar_alt: "' . $currentUser->fullname . '",
				user_profile: "' . $currentUser->profileURL() . '" 
    			';

    		}else{
    			echo '
    			avatar_path: "",
				avatar_alt: "",
				user_profile: ""
    			';
    		}
    		
    		?>
		};
	},

	render: function(){
		
		return (
			<a href={this.props.user_profile} >
			<img width="30px" height="30px" className="media-object" src={this.props.avatar_path} alt={this.props.avatar_alt} />
			</a>
		);

	}
});

var CommentActions = React.createClass({

	render: function(){
		return (
		<span className="actions comment" >
			<a href={"/user/comment/" + this.props.comment_id + "/delete"} type="button" className="btn btn-xs">x</a>	
		</span>
		);

	}
});

var Comment = React.createClass({
  render: function() {
	
    var rawMarkup = marked(this.props.children[1].toString(), {sanitize: true});
	var currentUser = this.props.currentUser;
	
	var avatarPath = this.props.children[0].props.avatar_path;
	var commentActions;

	if(this.props.author = currentUser.fullname)
	{
		commentActions = <CommentActions comment_id={this.props.children[2].props.comment_id} />;
	}else {
		commentActions = '';
	}

    return (
      <div className="media">
		<Avatar avatar_path={avatarPath} avatar_alt={this.props.author} user_profile={this.props.children[0].props.user_profile}/>
        <p className="media-heading">
         {this.props.author}
        </p>
        <p>
			<span dangerouslySetInnerHTML={{__html: rawMarkup}} className="body" />
			{commentActions}
		</p>
      </div>
    );
  }
});

var CommentBox = React.createClass({
  loadCommentsFromServer: function() {
		
    $.ajax({
      url: this.props.url,
      dataType: 'json',
      success: function(data) {
        this.setState({data: data.data});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },
  handleCommentSubmit: function(comment) {

	var comments = this.state.data;
	
	var newComment = {
		app_id: 1, 
		study_app_id: <?php echo $study->id;?>, 
		author: "<?php echo $currentUser->fullname;?>", 
		author_profile: "<?php echo $currentUser->profileURL();?>", 
		body:"ddddd",//comment.body
		avatar_path: "<?php echo $currentUser->present()->gravatar(); ?>",
		avatar_alt: "<?php echo $currentUser->fullname;?>"
		};

	comments = comments.concat([newComment]);
	
    this.setState({data: comments}, function() {
      // `setState` accepts a callback. To avoid (improbable) race condition,
      // `we'll send the ajax request right after we optimistically set the new
      // `state.
      $.ajax({
        url: this.props.url,
        dataType: 'json',
        type: 'POST',
        data: comment,
        success: function(data) {
			console.log(data);
          this.setState({data: data.data});
			
        }.bind(this),
        error: function(xhr, status, err) {
          console.error(this.props.url, status, err.toString());
        }.bind(this)
      });

    });
  },
  getInitialState: function() {
    return {data: []};
  },
  componentDidMount: function() {
    this.loadCommentsFromServer();
    setInterval(this.loadCommentsFromServer, this.props.pollInterval);
  },
  render: function() {

    return (
      <div className="commentBox">
        <h1>Comments</h1>
		<CommentForm onCommentSubmit={this.handleCommentSubmit} currentUser={this.props.currentUser}/>
        <CommentList data={this.state.data} currentUser={this.props.currentUser} />
      </div>
    );
  }
});

var CommentList = React.createClass({
  render: function() {
	var currentUser = this.props.currentUser;
    var commentNodes = this.props.data.map(function(comment, index) {
	
      return (
        
        // http://facebook.github.io/react/docs/multiple-components.html#dynamic-children
        <Comment author={comment.author} key={comment.app_id} currentUser={currentUser} >
			<Avatar avatar_path={comment.avatar_path} avatar_alt={comment.avatar_alt} />
          {comment.body}
		  <CommentActions comment_id={comment.app_id} />
			
        </Comment>
      );
    });
    return (
      <div className="commentList">
        {commentNodes}
      </div>
    );
  }
});

var CommentForm = React.createClass({
  handleSubmit: function(e) {
    e.preventDefault();

    var author = React.findDOMNode(this.refs.author).value.trim();
    var body = React.findDOMNode(this.refs.body).value.trim();	
	var token = React.findDOMNode(this.refs.token).value.trim();
	var commentable_id = React.findDOMNode(this.refs.commentable_id).value.trim();
	var commentable_type = React.findDOMNode(this.refs.commentable_type).value.trim();
	
    if (!body || !author) {
      return;
    }
    this.props.onCommentSubmit({author: author, body: body, token: token,commentable_id:commentable_id, commentable_type:commentable_type});

    React.findDOMNode(this.refs.author).value = '';
    React.findDOMNode(this.refs.body).value = '';
  },
  render: function() {

    return (
      <form className="commentForm" onSubmit={this.handleSubmit}>
		<?php
		echo str_replace('>','/>',Form::hidden('commentable_id',$study->id,['ref'=>'commentable_id'])); 
		echo str_replace('>','/>',Form::hidden('commentable_type',get_class($study),['ref'=>'commentable_type'])); 
		?>
		
		<input type="hidden" value="<?php echo csrf_token();?>" ref="token" />
        <input type="hidden" value="<?php echo Auth::user()->fullname;?>" ref="author" />
        <input type="text" name="body" id="body" placeholder="Say something..." ref="body" />
        <input type="submit" value="Post" />
      </form>
    );
  }
});

var onChange = function(){

	React.render(
 	 <CommentBox url="<?php echo url('api/v1/studies/'.$study->id.'/comments'); ?>" pollInterval={2000} currentUser='<?php echo Auth::user(); ?>' />,
  	document.getElementById('study-comments')
	);

};

onChange();

    </script>
    
  </body>
</html>