import React from 'react';
import ReactDOM from 'react-dom';
import { Editor, EditorState, RichUtils } from 'draft-js';

class MEditor extends React.Component {
  constructor(props) {
    super(props);
    this.state = { editorState: EditorState.createEmpty() };
    this.onChange = (editorState) => this.setState({ editorState });
    this.setEditor = (editor) => {
      this.editor = editor;
    };
    this.focusEditor = () => {
      if (this.editor) {
        this.editor.focus();
      }
    };
  }

  componentDidMount() {
    this.focusEditor();
  }

  handleKeyCommand(command, editorState) {
    const newState = RichUtils.handleKeyCommand(editorState, command);
    if (newState) {
      this.onChange(newState);
      return 'handled';
    }
    return 'not-handled';
  }

  onUnderlineClick() {
    this.onChange(
      RichUtils.toggleInlineStyle(this.state.editorState, "UNDERLINE")
    );
  };

  onBoldClick() {
    this.onChange(RichUtils.toggleInlineStyle(this.state.editorState, "BOLD"));
  };

  onItalicClick() {
    this.onChange(
      RichUtils.toggleInlineStyle(this.state.editorState, "ITALIC")
    );
  };

  onStrikeThroughClick() {
    this.onChange(
      RichUtils.toggleInlineStyle(this.state.editorState, "STRIKETHROUGH")
    );
  };

  onHighlight() {
    this.onChange(
      RichUtils.toggleInlineStyle(this.state.editorState, "HIGHLIGHT")
    );
  };

  render() {
    return (
      <div className="editorContainer">
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
        <div className="editors">
          <Editor
            editorState={this.state.editorState}
            handleKeyCommand={this.handleKeyCommand}
            plugins={this.plugins}
            onChange={this.onChange}
          />
        </div>
      </div>
    );
  }
}

const styles = {
  editor: {
    border: '1px solid gray',
    minHeight: '6em'
  }
};

if (document.getElementById('text-editrr')) {
  ReactDOM.render(
    <MEditor />,
    document.getElementById('text-editrr')
  );
}
