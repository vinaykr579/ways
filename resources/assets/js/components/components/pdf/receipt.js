import React,{Component, Fragment} from 'react';
import {PDFDownloadLink, Page, Text, View, Document, StyleSheet, Image } from '@react-pdf/renderer';
import {PDFFile} from '../ui/elements'
import {getTripTypeTitle} from '../../utils/helper'
const styles = StyleSheet.create({
    body: {
      padding: 35,
    },
    content: {
      padding: 20,
      paddingLeft:0,
      '@media max-width: 400': {
        flexDirection: 'column',
      },
      '@media min-width: 400': {
        flexDirection: 'row',
      },
    },
    block: {
      height: 80,
      width: 150,
      color: 'white'
    },
    listItem:{
        padding:5,
        '@media max-width: 400': {
            flexDirection: 'column',
        },
        '@media min-width: 400': {
            flexDirection: 'row',
        },
        width:525,
        fontSize:10
    }

  });
  
const DocHeader = () => {
    return (
        <View  style={styles.content}>
            <View style={[styles.block, {textAlign:'left'}]} >
                <Image style={{height:45, width:90}} src="images/logo.png"/>
                <Text 
                    style={{
                        color:'black', 
                        marginTop:10,
                        fontWeight:'bold',
                        fontSize:10
                    }}
                >PEPAL PVT. LTD.</Text>
                <Text 
                    style={{
                        color:'black', 
                        fontSize:8
                    }}
                >Vasant kunj, Delhi-110070</Text>
            </View>
            <View  style={[styles.block, {width:360,textAlign:'right',marginLeft:20}]} >
                <Text 
                        style={{
                            color:'black', 
                            fontSize:14
                        }} >Invoice Id: 
                        <Text style={{
                            fontWeight:'bold',
                            fontSize:14,
                            color:'black',
                        }}>1234567887665</Text>
                </Text>
                <Text 
                    style={{
                        color:'black', 
                        fontSize:12
                    }} > 24/07/2019 14:28 
                        
                </Text>
                <Text 
                    style={{
                        color:'black', 
                        marginTop:25,
                        fontWeight:'bold',
                        fontSize:10
                    }}
                >PEPAL PVT. LTD.</Text>
                <Text 
                    style={{
                        color:'black', 
                        fontSize:8
                    }}
                >Vasant kunj, Delhi-110070</Text>
            </View>
        </View>
        
    )
}

const ListTitle = (props) => {
    return (
        <View style={{textAlign:'left', fontSize:12, marginBottom:5, fontWeight:40}}>
            <Text>{props.title}</Text>
        </View>
    )
}

const TollsFeeLabel = (props) => {
    return (
        <View style={[styles.listItem, props.style]}>
            <Text  style={{textAlign:'left', width:10}}>Toll Fees</Text>
            <Text  style={{  width:200, paddingLeft:5, textAlign:'left'}}></Text>
            <Text  style={{textAlign:'right', paddingRight:210}}>
            <Image style={{height:15, width:6}} src="images/rupee.png"/>{props.tollFees}</Text>
        </View>
    )
}

const TollsFee = (props) => {
    return (
        <View style={[styles.listItem, props.style]}>
            <Text  style={{textAlign:'left', width:50}}>(a)Toll Fees</Text>
            <Text  style={{  width:200, paddingLeft:5, textAlign:'left'}}></Text>
            <Text  style={{textAlign:'right', paddingRight:255}}>
            <Image style={{height:10, width:5}} src="images/rupee.png"/>{props.tollFees}</Text>
        </View>
    )
}

const TaxDetails = (props) => {
    return (
        <Fragment >
            <View style={[styles.listItem, props.style]}>
                <Text  style={{textAlign:'left', width:150}}>(b)Booking Fees @{props.transaction.ConvenienceChargesTaxValue}%</Text>
                <Text  style={{  width:95, paddingLeft:5, textAlign:'left'}}></Text>
                <Text  style={{textAlign:'right', paddingRight:255}}>
                    <Image style={{height:7, width:5}} src="images/rupee.png"/>
                    {props.transaction.ConvenienceCharges}
                </Text>
            </View>
            <View style={[styles.listItem, props.style]}>
                <Text  style={{textAlign:'left', width:150}}>Integrated GST @{props.transaction.GSTTaxValue}%</Text>
                <Text  style={{  width:95, paddingLeft:5, textAlign:'left'}}></Text>
                <Text  style={{textAlign:'right', paddingRight:255}}>
                    <Image style={{height:7, width:5}} src="images/rupee.png"/>
                    {props.transaction.GST}
                </Text>
            </View>

        </Fragment>
    )
}


const AmountPayable = (props) => {
    return (
        <View style={[styles.listItem, props.style]}>
            <Text  style={{textAlign:'left', width:200}}>Amount Payable</Text>
            <Text  style={{  width:52, paddingLeft:5, textAlign:'left'}}></Text>
            <Text  style={{textAlign:'right', paddingRight:255}}>
                <Image style={{height:15, width:6}} src="images/rupee.png"/>
                {props.amount}
            </Text>
        </View>
    )
}


const VehicleHeader = (props) => {
    return (
        <View style={[styles.listItem, props.style]}>
            <Text  style={{textAlign:'left', width:150}}>Vehicles</Text>
            <Text  style={{  width:200, paddingLeft:5, textAlign:'center'}}>Vehicle Reference No</Text>
            <Text  style={{textAlign:'center', paddingRight:210}}>Fare</Text>
        </View>
    )
}

const VehicleBooking = (props) => {
    return (
        <View style={[styles.listItem, props.style]}>
            <Text  style={{textAlign:'left', width:150}}>{props.vbooking.RegistrationNumber}</Text>
            <Text  style={{  width:200, paddingLeft:5, textAlign:'center'}}></Text>
            <Text  style={{textAlign:'center', paddingRight:210}}>
                <Image style={{height:10, width:6}} src="images/rupee.png"/>
                {props.vbooking.TotalAmount}
            </Text>
        </View>
    )
}
const ListItem = (props) => {
    return (
        <View  style={[styles.listItem, props.style]}>
            <Text  style={{textAlign:'left', width:10}}>{props.sr}</Text>
            <Text  style={{  width:200, paddingLeft:5, textAlign:'left'}}>{props.title}</Text>
            <Text  style={{textAlign:'right', paddingRight:210}}>
                <Image style={{height:8, width:5}} src="images/rupee.png"/>
                {props.fare}
            </Text>
        </View>
    )
}

const RideDetails = (props) => {
    if(props.ride.BookingType === 'route-specific'){
        let i =0
        let listItemStyle = {}
        return (
            props.ride.AssociateRides.map(aride=>{
                return (
                    <Fragment key={aride.AssociateRideId}>
                        <ListTitle title={aride.Source_Name+'-'+aride.Destination_Name}/>
                        {aride.Tolls.map(toll => {
                           if(i%2 === 0){
                                listItemStyle = {backgroundColor:'#E4E4E4'}
                           }else{
                                listItemStyle = {}
                           }
                           return(
                               <ListItem 
                               key={toll.TollId}
                               sr={++i} 
                               title={toll.Name} 
                               fare={toll.TollFare}
                               style={listItemStyle}
                               />
                           ) 
                        })}
                    </Fragment>
                )
            })
        )
    }else{
        let tollname = props.ride.AssociateRides[0].Tolls[0].Name
        let tripType = getTripTypeTitle(props.ride.TripTypeId)
        let i =0
        let listItemStyle = {}
        return(
            <Fragment>
                <ListTitle title={tollname}/>
                {props.ride.AssociateRides.map(aride => {
                    if(i%2 === 0){
                        listItemStyle = {backgroundColor:'#E4E4E4'}
                    }else{
                        listItemStyle = {}
                    }
                    return (
                        <ListItem 
                         key={aride.AssociateRideId}
                         sr={++i} 
                         title={tripType} 
                         fare={aride.Tolls[0].TollFare}
                         style={listItemStyle}
                         />
                    )
                })}    
            </Fragment>
        )
    }
}

const TollList = (props) => {
    let vstyle = {}
    return (
        <View>
            <RideDetails ride={props.booking.Ride}/>
            <TollsFeeLabel 
                style={{backgroundColor:'#E4E4E4', fontSize:12, marginTop:5}}
                tollFees={props.booking.Ride.TotalAmount}
            />
            <VehicleHeader style={{backgroundColor:'#B5B5B5', fontSize:12, marginTop:5}}/>
            {props.booking.VehicleBookings.map((vbooking, index) => {
                if(index%2 === 0){
                    vstyle = {fontSize:10}
                }else{
                    vstyle = {backgroundColor:'#E4E4E4', fontSize:10}
                }
                return(
                    <VehicleBooking 
                        style={vstyle}
                        vbooking={vbooking}
                        key={index}
                    />
                )
            })}
            <TollsFee 
                style={{backgroundColor:'#E4E4E4', fontSize:8}}
                tollFees={props.booking.Transaction.TollAmount}
            />
            <TaxDetails 
            transaction={props.booking.Transaction} 
            style={{backgroundColor:'#E4E4E4', fontSize:8, padding:0}}/>
            <AmountPayable 
            amount={props.booking.Transaction.Amount}
            style={{backgroundColor:'#E4E4E4', fontSize:12}}/>
        </View>
    )
}

const PDFDoc = (props) => {
    return (
        <Document>
            <Page size="A4" style={styles1.page}>
                <View>
                    <DocHeader />
                    <TollList booking={props.booking}/>
                </View>
            </Page>
        </Document>
    )
}

const styles1 = StyleSheet.create({
    page: {
      flexDirection: 'row',
      padding:30,
      flexGrow:1,
      flex:0,
    },
    section: {
      marginTop: 200,
      padding: 10,
      textAlign:'left',
      width:'100%',
      height:20
    }
});
  
  

class Receipt extends Component {
    
    render() { 
        return (  
        
            <PDFDownloadLink 
            document={<PDFDoc booking={this.props.booking} />} 
            fileName="receipt.pdf">
                {({ blob, url, loading, error }) => (loading ? 'Loading document...' : <PDFFile />)}
            </PDFDownloadLink>
//            <PDFViewer><PDFDoc /></PDFViewer>
        
        );
    }
}
 
export default Receipt;
