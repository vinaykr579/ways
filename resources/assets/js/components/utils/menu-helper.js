export const NavMenus = [
    {
        to:"/dashboard",
        imageSrc:"images/dashboard.png",
        title: 'Dashboard'
    },
    {
        to:"#",
        imageSrc:"images/user.png",
        title: 'Users',
        subNavs:[
            {
                to:"/users/add",
                title:'Add User',
            },
            {
                to:"/users/manage",
                title:'Manage User',
            },
        ]
    },
    {
        to:"#",
        imageSrc:"images/vehicle.png",
        title: 'Rides',
        subNavs:[
            {
                to:"/rides/book",
                title:'Book Ride',
            },
            {
                to:"/rides/bookings",
                title:'Bookings',
            },
        ]
    }
]