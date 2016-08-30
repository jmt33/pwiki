class Header extends React.Component {
  render() {
    return (
        <header>
            <nav>
                <ul className="nav navbar-top-links">
                    <li><button type="button" className="btn btn-success">同步</button></li>
                    <li><button type="button" className="btn btn-info">重命名</button></li>
                    <li><button type="button" className="btn btn-warning">清空</button></li>
                </ul>
            </nav>
        </header>
    );
  }
}

class Markdown extends React.Component {
  constructor() {
    super();
    this.state = {
      converter: new showdown.Converter(),
      value: `Hello, World!\n===\n---\n# This is an h1\n## This is an h2\n### This is an h3\n#### This is an h4\n##### This is an h5\n###### This is an h6`,
    };
  }

  createMarkup() {
    return {__html: this.state.converter.makeHtml(this.state.value) };
  }

  handleChange(event) {
    this.setState({ value: event.target.value });
  }

  render() {
    return (<div className='row'>
              <div className ="markdown-write">
                <textarea
                  type='text'
                  defaultValue={this.state.value}
                  onChange={this.handleChange.bind(this)}
                  id='markdown'
                  className='col-xs-12 full-height'></textarea>
              </div>
              <div className='markdown-previewer'>
                <div id='htmlArea'
                     className='col-xs-12 full-height'>
                  <div dangerouslySetInnerHTML={this.createMarkup()} />
                </div>
              </div>
            </div>);
  }
}

class Footer extends React.Component {
  render() {
    return (<footer className='col-xs-8 col-xs-offset-2'>
              <hr />
              <p className='text-center'>
                Markdown Previewer created by <a href='http://jmt33.github.com/mtao' target='_blank' className='text-warning'>Mtao</a>
              </p>
            </footer>);
  }
}

class App extends React.Component {
  render() {
    return (<div className='container-fluid'>
              <Header/>
              <Markdown/>
              <Footer/>
            </div>);
  }
}

const div = document.createElement('div');
div.id = 'app';
document.body.appendChild(div);
ReactDOM.render(<App/>, document.getElementById('app'));
