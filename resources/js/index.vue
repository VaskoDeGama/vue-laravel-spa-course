<template>
    <div>
        <div class="navbar bg-light border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto" :to="{ name: 'home' }">Dashboard</router-link>
            <router-link class="nav-link" :to="{ name: 'booking-list', params: {id: 1} }">Bookings</router-link>
        </div>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>

    </div>
</template>