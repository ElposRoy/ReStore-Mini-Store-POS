<script setup>
import InputError from '@/Components/InputError.vue';

defineEmits(['saveRestock','close']);

defineProps([ 'dialog','restockForm','purchases','products','title']);


</script>

<template>

<v-dialog
          v-model="dialog"
          max-width="600px"
          persistent
        >
          <template v-slot:activator="{ props }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="props"
             
            >
              New Purchase
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ title }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                    <v-col
                    cols="12"
                    sm="8"
                    md="8"
                  >

                  <v-select
                    v-model="restockForm.product_id"
                    :items="products"
                    item-title="product_name"
                    item-value="id"
                    label="Product"
                    density="comfortable"
                  ></v-select>
                  <InputError :message="restockForm.errors.product_id"/>
                  </v-col> 

                  <v-col
                    cols="12"
                    sm="4"
                    md="4"
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
                @click="$emit('close',dialog=false)"
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


</template>