import React, {Component} from 'react';
import ReactPaginate from 'react-paginate'
import './pagination.css'

class Pagination extends Component{

    render(){
        return(
            <nav aria-label="Page navigation example" className="paginationNav">
                <ReactPaginate
                previousLabel={'previous'}
                nextLabel={'next'}
                breakLabel={'...'}
                breakClassName={'break-me'}
                pageCount={10}
                marginPagesDisplayed={2}
                pageRangeDisplayed={5}
                //   onPageChange={this.handlePageClick}
                containerClassName={'pagination'}
                subContainerClassName={'pages pagination'}
                activeClassName={'active'}
                />
            </nav>
        )
    }
    
}

export default Pagination