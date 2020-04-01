<html>
  <head>
    <title>Hello React</title>
    <script src="https://fb.me/react-0.13.2.js"></script>
    <script src="https://fb.me/JSXTransformer-0.13.2.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>
  </head>
  <body>
    
    <script type="text/jsx">

var notepad = {	
	notes: [],
	selectId: null
};

var nextNodeid = 1;

var onAddNote = function(){
	var note = {id: nextNodeId, title: '', description: ''};
	nextNodeId++;
	notepad.notes.push(note);
	notepad.selectId = note.id;
	onChange();
};

var onChangeNote = function(id, title, description){
	var note = _.find(notepad.notes, function(note){
		return note.id === id;	
	});
	if (note){
		note.title = title;
		note.description = description;
	}
	onChange();
};

var NoteSummary = React.createClass({

	render: function(){
		var note = this.props.note;
		var summary = note.description;

		return (
			<div className="NoteSummary">{summary}</div>
		);

	}
});

var NoteList = React.createClass({
	
	render: function(){
		
		var notes = this.props.notepad.notes;

		return (
			
			<div className="notelist">
			{
				notes.map(function (note){
				
					var title = note.title;
					var description = note.description;
					
					return (
						<div key={note.id} className="note-summary">
							{title}
							<NoteSummary key={note.id} note={note} />
						</div>
					);

				})
			}
			</div>
		);

	}

});

var onChange = function(){
	React.render(
		<NoteList notepad={notepad} />,
		document.body
	);
};

onChange();
    </script>
    
  </body>
</html>