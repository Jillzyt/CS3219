import "bootstrap/dist/css/bootstrap.css";
import React, { Component } from "react";

class App extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }
    componentDidMount() {
        this.callBackendAPI()
            .then((res) => this.setState({ data: res.data }))
            .catch((err) => console.log(err));
    }

    callBackendAPI = async() => {
        const response = await fetch("/message");
        const body = await response.json();

        if (response.status !== 200) {
            throw Error(body.message);
        }
        return body;
    };

    render() {
        return ( <
            div className = "App" >
            <
            div className = "container" >
            <
            h2 > Hello World.This is YuTing 's Task A1 assignment.</h2> <
            h4 > This is { this.state.data ? ? "" } < /h4> <
            /div> <
            /div>
        );
    }
}

export default App;