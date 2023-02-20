import Dashboard from "./components/Dashboard.vue";
import ListAppointment from "./pages/appointments/ListAppointment.vue";

export default [
    {
        path: "/admin/dashboard",
        name: "admin.dashboard",
        component: Dashboard,
    },
    {
        path: "/admin/appointment",
        name: "admin.appointment",
        component: ListAppointment,
    },
    // {
    //     path: "/admin/users",
    //     name: "admin.users",
    //     component: ListUsers,
    // },
    // {
    //     path: "/admin/settings",
    //     name: "admin.settings",
    //     component: UpdateSettings,
    // },
    // {
    //     path: "/admin/profile",
    //     name: "admin.profile",
    //     component: UpdateProfile,
    // },
    // {
    //     path: "/admin/logout",
    //     name: "admin.logout",
    //     component: Logout,
    // },
];
