<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3'
import { useForm, Head } from '@inertiajs/vue3';
import CartArea from '@/Components/order/CartArea.vue';
import CategoriesAndProduct from '@/Components/order/CategoriesAndProduct.vue';
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
      baseurl: location.origin,
      cartData: [
      

      ],
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
      this.addedd=true;
     
  
    },

    removeCartItem(itemID){
    // Find the index of the object with the matching id
    const index = this.cartData.findIndex((item) => item.id === itemID);
    // If the object exists, remove it from the array
    if (index !== -1) {
      this.cartData.splice(index, 1);
    }
    
    },
    MinusQuantity(){
      console.log('Minus')
    },
    AddQuantity(){
      console.log('Added')
    },
    clearCart(){
      this.cartData=[]
      
    }
  },
  }
</script>

<template>
    <Head title="Orders" />
  
    <AuthenticatedLayout>
     <div class="m-2">
      <v-row >
       
        <CategoriesAndProduct
        @selectCategory="selectCategory"
        @addToCart="addToCart"
       
        :products="products"
        :categories="categories"
        :selectedCategory ="selectedCategory "

        >

        </CategoriesAndProduct>


                  <!-- Cart Area -->
                  <CartArea
                  :cartData="cartData"
                  @clearCart="clearCart"
                  @MinusQuantity="MinusQuantity"
                  @AddQuantity="AddQuantity"
                  @removeCartItem="removeCartItem"
                  ></CartArea>
                  <!-- Cart Area -->


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
