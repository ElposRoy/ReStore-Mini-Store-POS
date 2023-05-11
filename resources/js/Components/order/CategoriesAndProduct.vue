<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

defineProps(['categories','products','selectedCategory','PushCart']);
defineEmits(['selectCategory','addToCart']);

</script>

<script>
  export default {
    data: () => ({
      baseurl: location.origin,
      
      page: parseInt(localStorage.getItem('currentPage')) || 1, //When currentPage is empty, value is 1.
      
    }),
    created(){
      // console.log(this.PushCart.Total)
      // console.log(this.products.id)
    },

    methods:{
      checkAddedd(PurchaseId){
    // Find the index of the object with the matching id
    const index = this.PushCart.myCart.findIndex((item) => item.PurchaseID === PurchaseId);
      
    // If the object exists, remove it from the array
    if (index !== -1) {
      return true;
    }
    else{
      return false;
    }
    },
    onPageChanged(pageNumber) {
    
      this.$inertia.visit(`/orders?page=${pageNumber}`);
      localStorage.setItem('currentPage', this.page); // Store this to Local Session for Data page: 
    
      localStorage.setItem('currentCart', JSON.stringify(this.PushCart.myCart));
    
      
    
      
    // console.log(`Page ${pageNumber} was selected`);
    //  console.log(this.page) this.page is outputting 1,2,3
    // console.log(pageNumber) this pageNumber is outputting only 1. Fix this one
    },
   
    }
  }
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
      <v-btn
      class="ma-2"
      rounded
      :color="selectedCategory.categoryId === '' ? 'blue-lighten-1' : undefined"
      @click="$emit('selectCategory','')"
      >
      All
      </v-btn>
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
        <v-row>
        <v-col cols="5">
          <!-- <v-autocomplete
            v-model="Search"
            :items="products.product_name"
            :values="products.id"
            label="Search"
            density="compact"
          ></v-autocomplete> -->
        </v-col>

        
      </v-row>

        <v-row >
          <v-col 
    v-for="product in products.data" 
    :key="product.product_name"
    :value="product.id"
    
    cols="12" md="4" sm="4"
  >
    <v-card>
      <v-img 
        :src="product.image ? 'http://127.0.0.1:8000/'+product.image : baseurl+'/images/DefaultImage.png'"
        class="align-end"
   
        :gradient="product.purchases.length !== 0 ? 'to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)' : 'to bottom, rgba(2,0,36,0.5676471272102591), rgba(1161,30,30,0.3939776594231442)'"
        height="200px"
        width="100%"
        cover
      >
        <v-card-title  class="text-white">
          <div class="d-flex justify-space-between">
            <v-chip
         variant="elevated"
      class="ma-1"
      color="light-blue-lighten-4"
    >
    <p>  {{ product.product_name }}</p>
    </v-chip>

           
            <v-chip
            
      class="ma-2"
      color="light-blue-lighten-5"
    >
    {{ product.unit }} Unit
    </v-chip>
         
          </div>
        
        </v-card-title>
      </v-img>

      <v-card-actions v-if="!product.purchases.length == 0" v-for="purchase in product.purchases" >
    
          <v-card-text>
            {{ purchase.quantity }} In Stock
            </v-card-text>

            <v-card-text >
              ₱ {{ purchase.sale_price }}
            </v-card-text>    
     
     

      <!-- Note: checkAddedd is a function at top, it checks for the product id in the PushCart.myCart Array-->
      <!-- New problem, change the product.id to purchase because when one product has two choice and select one, both got add button changes -->
      <!-- at @click emit change the product to purchase -->
        <v-btn  v-if="!checkAddedd(purchase.id)" prepend-icon="mdi mdi-plus-box" variant="tonal" color="success" @click="$emit('addToCart', purchase, product)"> 
        Add
        </v-btn>

          <!-- Note: if the top v-if is true, execute the v-else and show the icon-->
        <v-icon
        v-else="checkAddedd(purchase.id)"
        class="ma-2"
        variant="text"
        icon="mdi-check-decagram"
        color="blue-lighten-2"
      ></v-icon>

       
      </v-card-actions>

      <v-card-actions 
      v-if="product.purchases.length == 0"
      class="d-flex align-end flex-column ">
      <v-card color="red-darken-3 text-h10"  title="Out of stock"></v-card>
    </v-card-actions>


    </v-card>
  </v-col>

    </v-row>

    <!-- PAGINATION -->
    <v-container>
      <v-sheet class="text-center mt-3">
        <v-pagination
          v-model="page"
          :length="products.last_page"
          :total-visible="7"
          hide-default-footer
          @update:modelValue="onPageChanged"
      
        
        ></v-pagination>
        
      </v-sheet >
    </v-container>
    <!-- PAGINATION -->


    </v-container>
        </v-card>  
      
        

    </v-card>
</v-col>

    
</template>