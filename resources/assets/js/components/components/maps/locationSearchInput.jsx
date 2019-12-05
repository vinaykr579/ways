import React, { Component } from 'react';
import PlacesAutocomplete, {geocodeByAddress, getLatLng} from 'react-places-autocomplete';
import  './searchInput.css'  

class LocationSearchInput extends Component {
    constructor(props) {
        super(props);
        this.state = { address: '', style:{} };
      }
     
      handleChange = address => {
        this.setState({ 'address':address });
      };
     
      handleSelect = (address, placeId) => {
        geocodeByAddress(address)
          .then(results => getLatLng(results[0]))
          .then(latLng => {
              const addressInfo = {
                  Name : address,
                  PlaceId : placeId,
                  Latitude :  latLng.lat,
                  Longitude : latLng.lng
              }
              this.props.addressInfo(addressInfo);
          })
          .catch(error => console.error('Error', error));
          if(this.props.placeholder === 'Destination'){
            this.props.handleLocation(address)
            this.setState({
                'style':{
                    paddingLeft: parseInt(this.props.destinations.length*55)+54+'px'
                },
                'address':''

            })
          }else{
            this.setState({'address': address});
          }
      };
     
    render() { 
        return (  
            <PlacesAutocomplete
                value={this.state.address}
                onChange={this.handleChange}
                onSelect={this.handleSelect}
                highlightFirstSuggestion={true}
            >
                {({ getInputProps, suggestions, getSuggestionItemProps, loading }) => (
                <div className="autocomplete">
                    <input
                        {...getInputProps({
                            placeholder: this.props.placeholder,
                            className: 'location-search-input',
                            id:this.props.id
                        })}
                        value={this.state.address}
                        style={this.state.style}
                    />
                    <div className="autocomplete-dropdown-container">
                    {loading && <div>Loading...</div>}
                    {suggestions.map(suggestion => {
                        const className = suggestion.active
                        ? 'suggestion-item--active'
                        : 'suggestion-item';
                        // inline style for demonstration purpose
                        const style = suggestion.active
                        ? { backgroundColor: '#fafafa', cursor: 'pointer' }
                        : { backgroundColor: '#ffffff', cursor: 'pointer' };
                        return (
                        <div
                            {...getSuggestionItemProps(suggestion, {
                            className,
                            style,
                            })}
                        >
                            <span>{suggestion.description}</span>
                        </div>
                        );
                    })}
                    </div>
                </div>
                )}
            </PlacesAutocomplete>

        );
    }
}
 
export default LocationSearchInput;