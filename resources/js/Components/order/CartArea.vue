<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

defineProps(['cartData']);
defineEmits(['MinusQuantity','AddQuantity','clearCart','removeCartItem']);
</script>

<script>
  export default {
    data: () => ({
      baseurl: location.origin,
    }),
  }
</script>

<template>
<v-col cols="12" sm="4" md="4" >
    <v-card
       class="mx-auto "
       
       prepend-icon="mdi-basket"
      
     >
       <template v-slot:title>
         CART AREA
       </template>
       <template v-slot:append>
        <v-btn
        v-if="cartData.length!==0"
        size="x-small"
        class="ma-2"
        color="red"
        @click="$emit('clearCart')"
      >
        <v-icon
        start
        icon="mdi-cart-remove"
      
        ></v-icon>
         Clear Cart
      </v-btn>
       </template>
       <v-divider :thickness="8" class="border-opacity-100"></v-divider>
      
       <v-card
       class="overflow-y-auto"
       height="600"
       >
         <v-card 
       class="m-2"
       variant="outlined"
       v-for="(item, index) in cartData"
       :key="index"
       >
       <v-row no-gutters>
    <v-col
    col="12"
    md="2"
    sm="2"
    >
    <v-sheet class="pa-2 ma-2">
    <v-avatar
      class=""
      size="50"
      rounded="0"
    >
      <v-img  :src="item.image ? 'http://127.0.0.1:8000/'+item.image : baseurl+'/images/DefaultImage.png'"></v-img>
    </v-avatar>
    </v-sheet>
    </v-col>
    <v-col>

    <v-sheet class="pa-2 ma-2 mb-0 pb-0 d-flex justify-space-between">
    <div>
    <!-- Fix the item.unit, it must be the purchase price -->
    <p> {{ item.product_name }} <br> ₱ {{ item.purchases[0].sale_price  }}</p> 
    </div>

    <div>
    <v-text-field class="input-background-color" >
    <template v-slot:append>
    <v-icon color="green" @click="$emit('AddQuantity')" >
    mdi-plus-box-outline
    </v-icon>
    </template>
    <template v-slot:prepend>
    <v-icon color="red" @click="$emit('MinusQuantity')">
    mdi-minus-box-outline
    </v-icon>
    </template>
    </v-text-field>
    </div>

    <div>
    <p>₱ 123 <br>Unit: 6</p>
    </div>

    </v-sheet>

    </v-col>
    <v-icon
    size="small"
    color="red-lighten-1"
    class="ma-1 "
    @click="$emit('removeCartItem',item.id)"
    >
    mdi-delete
    </v-icon> 
    </v-row>
       

       </v-card>
       
      
       
       </v-card>
     </v-card>
     <v-divider :thickness="6" class="border-opacity-100"></v-divider>

     <v-card
     class="pa-2">
     Total
     </v-card>
       
     </v-col>

    </template>