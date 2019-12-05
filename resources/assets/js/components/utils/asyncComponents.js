import asyncComponent from '../hoc/asyncComponent'

export const asyncDashboard = asyncComponent(()=>{
    return import('../containers/dashboard'); 
})

export const asyncRides = asyncComponent(()=>{
    return import('../containers/ride')
})

export const asyncUsers = asyncComponent(()=>{
    return import('../containers/users')
})

export const asyncBookings = asyncComponent(()=>{
    return import('../containers/bookings')
})
