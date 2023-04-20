<script setup>
import InputError from '@/Components/InputError.vue';

defineEmits(['closeRestock','saveRestock'])

defineProps(['dialogRestock','restockForm','products','purchases']);
</script>

<script>
export default {
  data() {
    return {
     
    };
  },
 method: {
    created(){
     
    }
 }
}

</script>
 <template>
  <!-- EDIT DIALOG -->
  
  <v-dialog
          v-model="dialogRestock"
          max-width="550px"
          persistent
        >
        <v-card>
            <v-card-title>
              <span class="text-h5">Restock  {{ restockForm.product_name }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
               
                  <v-col
                    cols="12"
                    sm="3"
                    md="3"
                  >
                    <v-text-field
                      type="number"
                      v-model="restockForm.quantity"
                      label="Quantity"
                    ></v-text-field>
                    <InputError :message="restockForm.errors.quantity"/>
                  </v-col>

                  <v-col
                    cols="12"
                    sm="5"
                    md="5"
                  >
                    <v-text-field
                      v-model="restockForm.original_price"
                      label="Original Price"
                    ></v-text-field>
                    <InputError :message="restockForm.errors.original_price"/>
                  </v-col>

                  <v-col
                    cols="12"
                    sm="4"
                    md="4"
                 
                  >
                    <v-text-field
                      v-model="restockForm.sale_price"
                      label="Sale Price"
                    ></v-text-field>
                    <InputError :message="restockForm.errors.sale_price"/>
                  </v-col>

                  
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                    type="date"
                    v-model="restockForm.purchasedDate"
                    label="Purchased Date"
                    ></v-text-field>
                    <InputError :message="restockForm.errors.purchasedDate"/>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                    type="date"
                    v-model="restockForm.expirationDate"
                    label="Expiration Date"
                    ></v-text-field>
                    <InputError :message="restockForm.errors.expirationDate"/>
                  </v-col>
            
                </v-row>
             
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="$emit('closeRestock',dialogRestock=false)"
              >
                Cancel
              </v-btn>
           
              <v-btn
             
                color="blue-darken-1"
                variant="text"
                @click=" $emit('saveRestock', restockForm)"
              >
                Save
              </v-btn>

      

            </v-card-actions>
          </v-card>
        </v-dialog>
        
<!-- EDIT DIALOG -->
 </template>

 