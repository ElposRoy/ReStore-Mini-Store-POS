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
  // ProductImage: null,
  // ProductName: '',
  // OrigPrice: '',
  SalePrice: '',
  // Unit:'',
  Quantity: '',
  Price: '',
  TotalUnit:'',
  TotalPrice: 0,
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
      TotalPriceSum: null,
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
     //NOTE TO SELF ! WHen Key down add to total,
     GetTotal(){
      let total = 0;
      total = this.cartData.reduce((acc, item) => acc + Number(item.Price), 0);
      this.TotalPriceSum = parseFloat(total).toFixed(2)
      return this.TotalPriceSum;
     },
     
    handleQuantityInputKeyDown(event, PurchaseId) {
      const input = event.target;

    //Set Timeout to get the 0 or null value because it still gets the current value when deleting it.
      setTimeout(() => {
        if (input.value === '') {
       
        const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);

        if (index !== -1) {
          this.cartData[index].Quantity = 1 ;
          this.cartData[index].Price = Number(this.cartData[index].SalePrice * 1).toFixed(2); 
          this.cartData[index].TotalUnit = Number(this.cartData[index].Unit * 1);
          this.GetTotal();
        }
        event.preventDefault();
      }
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

        const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);

        if (index !== -1) {
          this.cartData[index].Quantity == inputValue;
          this.cartData[index].Price = Number(this.cartData[index].SalePrice * inputValue).toFixed(2); 
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
  
        this.cartData.push(newCartItem);
        this.GetTotal();
    
    },

    //Set the this.cartData.Price back to its original price when removed from cart
    removeCartItem(itemID){
    // Find the index of the object with the matching id
    const index = this.cartData.findIndex((item) => item.PurchaseID === itemID);
    // If the object exists, remove it from the array
    if (index !== -1) {
      this.cartData.splice(index, 1);
      this.GetTotal();
        //Call the GetTotal Function to Calculate the total
    }
    
    },

    MinusQuantity(PurchaseId,Quantity){
      const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);
   
      if(Quantity <= 1){
       
      }
      else{
        if (index !== -1) {
          this.cartData[index].Quantity -= 1;
        this.cartData[index].Price = Number(this.cartData[index].SalePrice * this.cartData[index].Quantity).toFixed(2); // Calculate the Total price when adding Quantity 
        this.cartData[index].TotalUnit = Number(this.cartData[index].Unit * this.cartData[index].Quantity); 

        this.GetTotal();
      //Call the GetTotal Function to Calculate the total
      // The total variable now contains the sum of all the Price values
        }
      }
     
    },

    AddQuantity(PurchaseId){
     
      const index = this.cartData.findIndex((item) => item.PurchaseID === PurchaseId);
     
      if (index !== -1) {
        this.cartData[index].Quantity = +this.cartData[index].Quantity + 1;   //+this.cartData[index].Quantity (The + sign turns the string value to number)
        this.cartData[index].Price = Number(this.cartData[index].SalePrice * this.cartData[index].Quantity).toFixed(2); // Calculate the Total price when adding Quantity 
        this.cartData[index].TotalUnit = Number(this.cartData[index].Unit * this.cartData[index].Quantity); 
          // Use reduce to sum all the prices
          //  Number() at item.Price. Convert it from string to number

          this.GetTotal();
        //Call the GetTotal Function to Calculate the total
        // The total variable now contains the sum of all the Price values
     

      }
   
    },
 
     //Set All of this.cartData.Price back to its original price when removed from cart
    clearCart(){
      this.cartData=[]
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
        :cartData="cartData"
        :products="products"
        :categories="categories"
        :selectedCategory ="selectedCategory "

        >

        </CategoriesAndProduct>


                  <!-- Cart Area -->
                  <CartArea
                  @handleQuantityInputKeyDown="handleQuantityInputKeyDown"
                  @KeyisNumeric="KeyisNumeric"
                  :cartData="cartData"
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
