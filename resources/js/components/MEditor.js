import React from 'react';
import ReactDOM from 'react-dom';
import { Editor, EditorState, RichUtils, convertToRaw, convertFromRaw, ContentState } from 'draft-js';

class MEditor extends React.Component {
  constructor(props) {
    super(props);
    this.state = { editorState: EditorState.createEmpty() };
    // this.onChange = (editorState) => this.setState({ editorState });
    // this.setEditor = (editor) => {
    //   this.editor = editor;
    // };
    // use of fat arrow functions was producing an error on build
    // manually binding this instead
    this.onBoldClick = this.onBoldClick.bind(this);
    // this.onChange = this.onChange.bind(this);
    this.handleKeyCommand = this.handleKeyCommand.bind(this);
    this.onUnderlineClick = this.onUnderlineClick.bind(this);
    this.onItalicClick = this.onItalicClick.bind(this);
    this.onStrikeThroughClick = this.onStrikeThroughClick.bind(this);
    this.saveDraft = this.saveDraft.bind(this);
    this.onClearEditor = this.onClearEditor.bind(this);
  }

  saveDraft() {
    const contentState = this.state.editorState.getCurrentContent();
    window.localStorage.setItem('draft', JSON.stringify(convertToRaw(contentState)));
    this.copyToHiddenBody();
  }

  onChange(editorState) {
    this.setState({ editorState });
    this.saveDraft();
  }

  copyToHiddenBody() {
    if (window.localStorage.getItem('draft') !== null && window.localStorage.getItem('draft') !== '') {
      try {
        if (JSON.parse(window.localStorage.getItem('draft')) !== '') {
          var textBlocks = _.filter(JSON.parse(window.localStorage.getItem('draft')).blocks, function (b) { return b.text !== null && b.text !== ''; });
          if (textBlocks.length > 0) {
            document.getElementById('body').value = window.localStorage.getItem('draft');
          }
        }
      } catch (e) {
        console.log(e);
      }
    }
  }

  componentDidMount() {
    if (this.props.injectedContent === null || this.props.injectedContent === '') {
      var content = window.localStorage.getItem('draft');
    } else {
      var content = this.props.injectedContent;
    }

    if (content) {
      try {
        JSON.parse(content);
      } catch (e) {
        content = '{"blocks":[{"key":"dl1f8","text":"' +
          content +
          '","type":"unstyled","depth":0,"inlineStyleRanges":[],"entityRanges":[],"data":{}}],"entityMap":{}}';
      }
    }

    if (content === null) {
      this.setState({ editorState: EditorState.createEmpty() });
    } else {
      this.setState({ editorState: EditorState.createWithContent(convertFromRaw(JSON.parse(content))), placeholder: 'Dear X,' });
    }
    this.copyToHiddenBody();
  }

  handleKeyCommand(command, editorState) {
    const newState = RichUtils.handleKeyCommand(editorState, command);
    if (newState) {
      this.onChange(newState);
      return 'handled';
    }
    return 'not-handled';
  }

  onUnderlineClick(event) {
    event.preventDefault();
    this.onChange(
      RichUtils.toggleInlineStyle(this.state.editorState, "UNDERLINE")
    );
  };

  onBoldClick(event) {
    event.preventDefault();
    this.onChange(RichUtils.toggleInlineStyle(this.state.editorState, "BOLD"));
  };

  onItalicClick(event) {
    event.preventDefault();
    this.onChange(
      RichUtils.toggleInlineStyle(this.state.editorState, "ITALIC")
    );
  };

  onStrikeThroughClick(event) {
    event.preventDefault();
    this.onChange(
      RichUtils.toggleInlineStyle(this.state.editorState, "STRIKETHROUGH")
    );
  };

  onClearEditor() {
    this.onChange(EditorState.createEmpty());
    window.localStorage.removeItem('draft');
    document.getElementById('body').value = window.localStorage.getItem('draft');
  }


  render() {
    return (
      <div className="editorContainer">
        <div>
          <button className="underline btn btn-outline-secondary" onClick={this.onUnderlineClick}>
            U
        </button>
          <button className="bold btn btn-outline-secondary" onClick={this.onBoldClick}>
            <b>B</b>
          </button>
          <button className="italic btn btn-outline-secondary" onClick={this.onItalicClick}>
            <em>I</em>
          </button>
          <button className="strikethrough btn btn-outline-secondary" onClick={this.onStrikeThroughClick}>
            abc
        </button>
        </div>
        <div className="editors">
          <Editor
            editorState={this.state.editorState}
            handleKeyCommand={this.handleKeyCommand}
            plugins={this.plugins}
            onChange={this.onChange.bind(this)}
          />
        </div>
        <a href="#" className="" onClick={this.onClearEditor}>
          Clear
        </a>
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

if (document.getElementById('text-editrr')) {
  ReactDOM.render(
    <MEditor injectedContent={body_rr} />,
    document.getElementById('text-editrr')
  );
}
