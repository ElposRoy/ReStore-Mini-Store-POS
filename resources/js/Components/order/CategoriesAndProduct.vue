<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

defineProps(['categories','products','selectedCategory']);
defineEmits(['selectCategory','addToCart']);
</script>


<template>

<v-col cols="12" sm="8" md="8" >
    <v-card class="mx-auto">

      <!--  New Solution, Use v-slide-group-->
      <v-col cols="12" sm="12" md="12">
        CATEGORIES
        <v-list v-model="selectedCategory.categoryId">
</v-list>
<v-sheet
class="mx-auto"
>
<v-slide-group
show-arrows
@category-selected="selectedCategory.categoryId = $event"
>
<v-slide-group-item
v-for="(category) in categories"
:key="category.id"

>
<v-btn
class="ma-2"
rounded
:color="selectedCategory.categoryId === category.id ? 'success' : undefined"
@click="$emit('selectCategory',category.id)"
>
{{ category.title }}
</v-btn>
</v-slide-group-item>

</v-slide-group>
</v-sheet>



      </v-col>
    <v-divider :thickness="8" class="border-opacity-100"></v-divider>

      <v-card
      class="mx-auto"
      >

      <v-container fluid>
        <v-row dense>
          
          <v-col
    v-for="product in products.data" 
    :key="product.product_name"
    :value="product.id"
    cols="4"
  >
    <v-card>
      <v-img 
        :src="'http://127.0.0.1:8000/'+product.image"
        class="align-end"
        gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
        height="200px"
        cover
      >
        <v-card-title class="text-white" v-text="product.product_name"></v-card-title>
      </v-img>

      <v-card-actions v-for="purchase in product.purchases" :key="purchase.id" >
        
          <v-card-text >
              {{ product.unit}} Unit
            </v-card-text>

            <v-card-text >
              ₱ {{ purchase.sale_price }}
            </v-card-text>
            
        <v-btn prepend-icon="mdi mdi-plus-box" variant="tonal" color="success" @click="$emit('addToCart', product)">
          ADD
        </v-btn>
       
      </v-card-actions>
    </v-card>
  </v-col>

</v-row>
</v-container>
</v-card>      
</v-card>
</v-col>

    
</template>