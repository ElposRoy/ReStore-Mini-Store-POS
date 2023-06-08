
<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
</script>
<script>
 export default {
   data() {
     return {
       drawer: null,
       items: [
         { icon: 'mdi-view-dashboard', title: 'Dashboard', route: 'Admin' },
         { icon: 'mdi-home-city', title: 'Home', route: 'dashboard', exact: true },
         { icon: 'mdi-warehouse', title: 'Products', route: 'products.index' }, //Product Page
         { icon: 'mdi-cart-arrow-down', title: 'Purchases', route: 'purchases.index' }, //Purchases Page
         { icon: 'mdi-account-multiple', title: 'User', route: 'Sem' }, // Just delete this, just for testing SEM
         { icon: 'mdi-star', title: 'Starred', route: 'Sem' },
       ],
     };
   },
 };
 </script>
<template>
   <v-card>
     <v-app>
       <v-navigation-drawer   v-model="drawer"
        expand-on-hover
        clipped>
         <v-list>
           <v-list-item
             prepend-avatar="https://cdn.vuetifyjs.com/images/john.png"
             title="John Leider"
             subtitle="john@google.com"
           >
             <template v-slot:append>
               <v-btn size="small" variant="text" icon="mdi-menu-down"></v-btn>
             </template>
           </v-list-item>
         </v-list>
 
         <v-divider :thickness="5" color="info"></v-divider>
 
         <v-list :lines="false" density="compact" nav>
           <v-list-item
             v-for="(item, i) in items"
             :key="i"
             :exact="item.exact"
             :href="route(item.route)"
             :active="route().current(item.route)"
             active-color="blue-darken-1"
           >
             <template v-slot:prepend>
               <v-icon :icon="item.icon"></v-icon>
             </template>
             <!-- Use Inertia Link tag to not load page when clicking link -->
             <Link :href="route(item.route)"> 
      <v-list-item-title v-text="item.title"></v-list-item-title>
    </Link>
           </v-list-item>
         </v-list>
       </v-navigation-drawer>
 
       <v-app-bar app clipped-left>
         <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
         <v-toolbar-title>ADMIN</v-toolbar-title>
       </v-app-bar>
 
       <v-main>
        <slot />
         <!-- Your main content here -->
       </v-main>
     </v-app>
   </v-card>
 </template>
 
 
 





