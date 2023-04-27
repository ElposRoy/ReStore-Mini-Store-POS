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

const PushCart = useForm ({
  ProductID : null,
  PurchaseID : null,
  ProductImage: null,
  ProductName: '',
  OrigPrice: '',
  SalePrice: '',
  Unit:'',
  Quantity: 1,
  TotalPrice: '',
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
    addToCart(purchase,product) {
   
      // Error with this commented code is, 
      // The issue with the code could be that this.PushCart is an object that is being modified and pushed into the cartData array.
      // Therefore, each time the addToCart function is called, it is modifying the same this.PushCart object and pushing it into the cartData array.
      // Pushcart should be used to submit to the controller
  // this.PushCart.ProductID=product.id;
  // this.PushCart.PurchaseID=purchase.id;
  // this.PushCart.ProductImage=product.image;
  // this.PushCart.ProductName=product.product_name;
  // this.PushCart.OrigPrice=purchase.original_price;
  // this.PushCart.SalePrice=purchase.sale_price;
  // this.PushCart.Unit=product.unit;
  // this.PushCart.TotalPrice=product.sale_price;
  // this.cartData.push(this.PushCart);

  const newCartItem = {}; //New object to be store the values
  newCartItem.ProductID = product.id;
  newCartItem.PurchaseID = purchase.id;
  newCartItem.ProductImage = product.image;
  newCartItem.ProductName = product.product_name;
  newCartItem.OrigPrice = purchase.original_price;
  newCartItem.SalePrice = purchase.sale_price;
  newCartItem.Unit = product.unit;
  newCartItem.Quantity = 1;
  newCartItem.TotalPrice = purchase.sale_price; //Total price will start at sale price and add on when quantity is addedd

  // newCartItem.Quantity = product.unit; Quantity is fixed to 1
  
  this.cartData.push(newCartItem);
  
    
    },

    removeCartItem(itemID){
    // Find the index of the object with the matching id
    const index = this.cartData.findIndex((item) => item.PurchaseID === itemID);
    // If the object exists, remove it from the array
    if (index !== -1) {
      this.cartData.splice(index, 1);
    }
    
    },

    MinusQuantity(){
      console.log('Minus')
    },
    AddQuantity(PurchaseId,Qty){
      const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);

    if (index !== -1) {
      this.cartData[index].Quantity = Qty;
    }


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
        :cartData="cartData"
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
