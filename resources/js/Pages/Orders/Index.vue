<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3'
import { useForm, Head } from '@inertiajs/vue3';
defineProps(['categories','products']);

const selectedCategory = useForm ({
  categoryId : null,
});
</script>

<script>

  export default {
    // props: ['categories'], <-- You can also use this props instead of the top defineProps
    // Use Created for consoling when refreshed or reloaded
    created() {
    // props are exposed on `this`.
    // console.log(this.products.data);

  
  },


    data: () => ({
      isSelected: false,
     
      cartData: [],
     
    }),
    
  computed: {
    // totalCost() {
    //   return this.cartData.reduce((acc, item) => acc + item.price, 0);
    // },
  },
  watch: {
    
  },

  methods: {
    selectCategory(item){
   
      this.selectedCategory.categoryId = item
      // console.log(this.selectedCategory.categoryId)
    },
    addToCart(item) {
    
      this.cartData.push(item);
      console.log(this.cartData)
    },
    removeCartItem(){
    
    },
  },
  }
</script>

<template>
    <Head title="Orders" />
  
    <AuthenticatedLayout>
     <div class="m-2">
      <v-row >
       

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
    @click="selectCategory(category.id)"
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
                 <!-- Change the product to purchase Props that comes with the price-->
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
                  
              <v-btn prepend-icon="mdi mdi-plus-box" variant="tonal" color="success" @click="addToCart(product)">
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

                  <v-col cols="12" sm="4" md="4" >
                 <v-card
                    class="mx-auto "
                    
                    prepend-icon="mdi-basket"
                   
                  >
                    <template v-slot:title>
                      CART AREA
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
                <v-img  :src="'http://127.0.0.1:8000/'+item.image"></v-img>
              </v-avatar>
        </v-sheet>
      </v-col>
      <v-col>
       
        <v-sheet class="pa-2 ma-2 mb-0 pb-0 d-flex justify-space-between">
      <div>
        <!-- Fix the item.unit, it must be the purchase price -->
        <p> {{ item.product_name }} <br>{{ item.unit }}</p> 
      </div>

      <div>
            <v-text-field class="input-background-color" >
    <template v-slot:append>
      <v-icon color="green">
        mdi-plus-box-outline
      </v-icon>
    </template>
    <template v-slot:prepend>
      <v-icon color="red">
        mdi-minus
      </v-icon>
    </template>
  </v-text-field>
           </div>
           
      <div class="">
        <p>₱ 123 <br>Pcs: 1</p>
      </div>
      
        </v-sheet>
        
      </v-col>
            <v-icon
            size="small"
            color="red-lighten-1"
            class="ma-1 "
            @click="removeCartItem(); "
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
                  </v-row>
     </div>
           
                  
    </AuthenticatedLayout>
    
    
</template>
<style>
  .input-background-color input {
    border-radius: 10%;
    background-color: rgb(221, 221, 221);
    color: rgb(0, 0, 0);
  }
</style>
