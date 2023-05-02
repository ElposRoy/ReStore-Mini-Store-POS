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
  TotalUnit: '',
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
    KeyisNumeric(event, PurchaseId) {
      if (!/\d/.test(event.key)) {
        event.preventDefault(); //Prevent Inputting Letters 
      } else {
        // Else number is only allowed and run the code inside to get the input value then push to cartData
        const input = event.target;
        const start = input.selectionStart;
        const end = input.selectionEnd;
        console.log(start)
        let inputValue = parseInt(input.value, 10); // Convert existing input to a number
        inputValue = isNaN(inputValue) ? 0 : inputValue; // Check if existing input is not a number, set to 0

        if (start === end) {
          // Input field is not selected, concatenate new input with existing value as a number
          inputValue = parseInt(inputValue + event.key, 10); // Concatenate new input with existing value and convert to a number
        } else {
          // Input field is selected, replace selected text with new input as a number
          inputValue = parseInt(input.value.slice(0, start) + event.key + input.value.slice(end), 10); // Replace selected text with new input and convert to a number
        }

        const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);

        if (index !== -1) {
          this.cartData[index].Quantity == inputValue;
          
          // Get the total and unit using the new input value
          this.cartData[index].TotalPrice = Number(this.cartData[index].SalePrice * inputValue).toFixed(2); 
          this.cartData[index].TotalUnit = Number(this.cartData[index].Unit * inputValue); 
        }
      }
    },

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
  newCartItem.TotalUnit = product.unit;
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

    MinusQuantity(PurchaseId,Quantity){
      const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);

      if(Quantity <= 1){
       
      }
      else{
        if (index !== -1) {
          this.cartData[index].Quantity -= 1;
        this.cartData[index].TotalPrice = Number(this.cartData[index].SalePrice * this.cartData[index].Quantity).toFixed(2); // Calculate the Total price when adding Quantity 
        this.cartData[index].TotalUnit = Number(this.cartData[index].Unit * this.cartData[index].Quantity); 


        }
      }
     
    },

    AddQuantity(PurchaseId){
     
      const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);

      if (index !== -1) {
        this.cartData[index].Quantity = +this.cartData[index].Quantity + 1;   //+this.cartData[index].Quantity (The + sign turns the string value to number)
        this.cartData[index].TotalPrice = Number(this.cartData[index].SalePrice * this.cartData[index].Quantity).toFixed(2); // Calculate the Total price when adding Quantity 
        this.cartData[index].TotalUnit = Number(this.cartData[index].Unit * this.cartData[index].Quantity); 

      }
     
    },

    clearCart(){
      this.cartData=[]
    },
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
                  @KeyisNumeric="KeyisNumeric"
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
    background-color: rgb(236, 236, 236);
    color: rgb(0, 0, 0);
  }
</style>
