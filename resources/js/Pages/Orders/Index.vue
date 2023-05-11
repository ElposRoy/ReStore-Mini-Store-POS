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

const PushCart= useForm ({
  myCart: JSON.parse(localStorage.getItem('currentCart')) || [],
  Total: 0,
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
      TotalPriceSum: parseInt(localStorage.getItem('currentTotal')) || null,
      isSelected: false,
      baseurl: location.origin,
     
    }),
    
  computed: {
    // totalCost() {
    //   return this.PushCart.myCart.reduce((acc, item) => acc + item.price, 0);
    // },
  },
  watch: {
    
  },

  methods: {
     //NOTE TO SELF ! WHen Key down add to total,
     GetTotal(){
      let total = 0;
      total = this.PushCart.myCart.reduce((acc, item) => acc + Number(item.Price), 0);
      this.TotalPriceSum = parseFloat(total).toFixed(2)
      localStorage.setItem('currentTotal', this.TotalPriceSum); 
      return this.TotalPriceSum;
     },
     
    handleQuantityInputKeyDown(event, PurchaseId) {
      const input = event.target;
     
    //Set Timeout to get the 0 or null value because it still gets the current value when deleting it.
      setTimeout(() => {
        if (input.value === '') {
       
        const index = this.PushCart.myCart.findIndex((item) => item.PurchaseID === PurchaseId);

        if (index !== -1) {
          this.PushCart.myCart[index].Quantity = 1 ;
          this.PushCart.myCart[index].Price = Number(this.PushCart.myCart[index].SalePrice * 1).toFixed(2); 
          this.PushCart.myCart[index].TotalUnit = Number(this.PushCart.myCart[index].Unit * 1);
          
        }
       
        event.preventDefault();
      }
      this.GetTotal();
    }, 200);
    
    },

    KeyisNumeric(event, PurchaseId) {

      if (!/\d/.test(event.key)) {
        event.preventDefault(); //Prevent Inputting Letters 
      } 
          else {
        const input = event.target;
        const start = input.selectionStart;
        const end = input.selectionEnd;
          
        let inputValue = input.value.trim(); // Get input value and remove whitespace
        
        if (start === end) {
          inputValue = parseInt(inputValue + event.key, 10); // Concatenate new input with existing value and convert to a number
          
        } 

        else {
          inputValue = parseInt(input.value.slice(0, start) + event.key + input.value.slice(end), 10); // Replace selected text with new input and convert to a number
        }

        const index = this.PushCart.myCart.findIndex((item) => item.PurchaseID === PurchaseId);

        if (index !== -1) {
          this.PushCart.myCart[index].Quantity == inputValue;
          this.PushCart.myCart[index].Price = Number(this.PushCart.myCart[index].SalePrice * inputValue).toFixed(2); 
          this.PushCart.myCart[index].TotalUnit = Number(this.PushCart.myCart[index].Unit * inputValue); 
        }
      }
    },

    selectCategory(item){
   
      this.selectedCategory.categoryId = item
      // console.log(this.selectedCategory.categoryId)
    },

    addToCart(purchase,product) {
 
      // Error with this commented code is, 
      // The issue with the code could be that this.PushCart is an object that is being modified and pushed into the PushCart.myCart array.
      // Therefore, each time the addToCart function is called, it is modifying the same this.PushCart object and pushing it into the PushCart.myCart array.
      // Pushcart should be used to submit to the controller

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
      newCartItem.Price = purchase.sale_price; //Total price will start at sale price and add on when quantity is addedd
    
      // newCartItem.Quantity = product.unit; Quantity is fixed to 1
  
        this.PushCart.myCart.push(newCartItem);
        this.GetTotal();
    
    },

  
    removeCartItem(itemID){
    // Find the index of the object with the matching id
    const index = this.PushCart.myCart.findIndex((item) => item.PurchaseID === itemID);
    // If the object exists, remove it from the array
    if (index !== -1) {
      this.PushCart.myCart.splice(index, 1);
      this.GetTotal();
        //Call the GetTotal Function to Calculate the total
    }
    
    },

    MinusQuantity(PurchaseId,Quantity){
      const index = this.PushCart.myCart.findIndex((item) => item.PurchaseID === PurchaseId);
   
      if(Quantity <= 1){
       
      }
      else{
        if (index !== -1) {
          this.PushCart.myCart[index].Quantity -= 1;
        this.PushCart.myCart[index].Price = Number(this.PushCart.myCart[index].SalePrice * this.PushCart.myCart[index].Quantity).toFixed(2); // Calculate the Total price when adding Quantity 
        this.PushCart.myCart[index].TotalUnit = Number(this.PushCart.myCart[index].Unit * this.PushCart.myCart[index].Quantity); 

       
      //Call the GetTotal Function to Calculate the total
      // The total variable now contains the sum of all the Price values
        }
      }
     
    },

    AddQuantity(PurchaseId){
     
      const index = this.PushCart.myCart.findIndex((item) => item.PurchaseID === PurchaseId);
     
      if (index !== -1) {
        this.PushCart.myCart[index].Quantity = +this.PushCart.myCart[index].Quantity + 1;   //+this.PushCart.myCart[index].Quantity (The + sign turns the string value to number)
        this.PushCart.myCart[index].Price = Number(this.PushCart.myCart[index].SalePrice * this.PushCart.myCart[index].Quantity).toFixed(2); // Calculate the Total price when adding Quantity 
        this.PushCart.myCart[index].TotalUnit = Number(this.PushCart.myCart[index].Unit * this.PushCart.myCart[index].Quantity); 
          // Use reduce to sum all the prices
          //  Number() at item.Price. Convert it from string to number

          this.GetTotal();
        //Call the GetTotal Function to Calculate the total
        // The total variable now contains the sum of all the Price values
     

      }
   
    },
    SubmitOrder() {
          this.PushCart.Total=this.TotalPriceSum;
          // Send cartData to server
          this.PushCart.post(route('orders.store'));
      },
 
  
    clearCart(){
      this.PushCart.myCart=[]
      localStorage.removeItem('currentCart');
     
     this.GetTotal();
        //Call the GetTotal Function to Calculate the total
    },

    
  },
  }
</script>

<template>
    <Head title="Orders" />
  
    <AuthenticatedLayout>
     <div class="m-4">
      <v-row >
       
        <CategoriesAndProduct
        @selectCategory="selectCategory"
        @addToCart="addToCart"
        :PushCart="PushCart"
        :products="products"
        :categories="categories"
        :selectedCategory ="selectedCategory "
      
        >

        </CategoriesAndProduct>


                  <!-- Cart Area -->
                  <CartArea
                  @SubmitOrder="SubmitOrder"
                  @handleQuantityInputKeyDown="handleQuantityInputKeyDown"
                  @KeyisNumeric="KeyisNumeric"
                  :PushCart="PushCart"
                  :TotalPriceSum="TotalPriceSum"
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
