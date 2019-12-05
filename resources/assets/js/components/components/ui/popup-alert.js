import React, { Component } from 'react';
import Modal from 'react-bootstrap/Modal'
import {Button} from './elements'

class PopupAlert extends Component {
    
    render() {
      return (
        <Modal
          {...this.props}
          size="lg"
          style={{
              opacity:1,
              position:"absolute",
              top: "30%",
              margin:"auto"
            }}
          aria-labelledby="contained-modal-title-vcenter"
          centered = {true}
        >
          <Modal.Header style={{
            display: "flex",
            alignItems: "flex-start",
            justifyContent: "space-between",
            padding: "1rem"
          }} closeButton>
            <Modal.Title id="contained-modal-title-vcenter"  >
              {this.props.title?this.props.title:''}
            </Modal.Title>
          </Modal.Header>
          <Modal.Body>
            {this.props.content?this.props.content:''}
          </Modal.Body>
          <Modal.Footer>
            <Button className={["btns"]} onClick={this.props.onHide}>Close</Button>
          </Modal.Footer>
        </Modal>
      );
    }
  }

  export default PopupAlert