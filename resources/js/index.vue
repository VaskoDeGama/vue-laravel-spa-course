<template>
    <div>
        <div class="navbar bg-light border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto" :to="{ name: 'home' }">Dashboard</router-link>
            <router-link class="btn navbar-item" :to="{ name: 'second' }">Second</router-link>
        </div>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>

    </div>
</template>