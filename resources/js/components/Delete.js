import Axios from 'axios';
import React from 'react';
import ReactDOM from 'react-dom';
import swal from 'sweetalert';

function Delete(props) {
    const destroy = (e) => {
        const afterDeleted = e.currentTarget.parentNode.parentNode.parentNode
        // console.log(afterDeleted);
        swal("Are You Sure?", {
            buttons: ["No", "Yes"]
        }).then((value) => {
            if (value == true) {
                
                axios.delete(props.endpoint).then((response) => {
                    // console.log(response.data);
                    afterDeleted.remove()
                })
            
            }
        });
    }
    return (
        <button onClick={ destroy } className="btn btn-danger btn-sm">Delete</button>
    );
}

export default Delete;

if (document.querySelectorAll('.delete')) {
    const deleteNodes = document.querySelectorAll('.delete')
    deleteNodes.forEach((item) => {
        var endpoint = item.getAttribute('endpoint')
        ReactDOM.render(<Delete endpoint = { endpoint }/>, item);
    })
}
