import React from 'react';
import ReactDOM from 'react-dom';
import { Editor, EditorState, RichUtils, convertToRaw, convertFromRaw, ContentState } from 'draft-js';

class MView extends React.Component {
  constructor(props) {
    super(props);
    this.state = { editorState: EditorState.createEmpty() };
    this.createState.bind(this);
  }

  createState() {
    try {
      JSON.parse(this.props.injectedContent);
      this.setState({ editorState: EditorState.createWithContent(convertFromRaw(JSON.parse(this.props.injectedContent))) });
      return;
    } catch (e) {
      // console.log(e);
    }
    var content = '{"blocks":[{"key":"dl1f8","text":"' +
      this.props.injectedContent +
      '","type":"unstyled","depth":0,"inlineStyleRanges":[],"entityRanges":[],"data":{}}],"entityMap":{}}';
    this.setState({ editorState: EditorState.createWithContent(convertFromRaw(JSON.parse(content))) });
  }

  componentDidMount() {
    this.createState();
  }

  render() {
    return (
      <div className="editorContainer">
        <div className="editors">
          <Editor
            editorState={this.state.editorState}
            readOnly={true}
          />
        </div>
      </div>
    );
  }
}

const styles = {
  editor: {
    border: '1px solid gray',
    minHeight: '8em'
  }
};

if (document.getElementById('text-viewrr')) {
  ReactDOM.render(
    <MView injectedContent={body_rr} />,
    document.getElementById('text-viewrr')
  );
}
