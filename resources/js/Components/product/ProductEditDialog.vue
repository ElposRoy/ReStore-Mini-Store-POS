<script setup>
import InputError from '@/Components/InputError.vue';

defineEmits(['closeDialog','editSubmitForm'])

defineProps(['dialogEdit','products','editForm','categories','unit_types']);
</script>

 <template>
  <!-- EDIT DIALOG -->
  
  <v-dialog
          v-model="dialogEdit"
          max-width="550px"
          persistent
        >
          <v-card>
            <v-card-title>
              <span class="text-h5">Edit Product</span>
            </v-card-title>

            <v-card-text>
              <form @submit.prevent="submitProducts">
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="3"
                  >
                  <v-avatar
                        size="100"
                        rounded="0"
                        class="p-2"
                      >
                        <v-img cover :src="'http://127.0.0.1:8000/'+editForm.image"></v-img>
                      </v-avatar> 

                  </v-col> 
                  <v-col
                    cols="12"
                    sm="6"
                    md="8"
                  >
            

                  <div class="mb-4">
                    <label for="file" class="block font-medium text-gray-700 mb-3">Change Image</label>
                    <input
                        @input="editForm.image=$event.target.files[0]"
                        type="file"
                        name="image"
                        id="image"
                        required
                        placeholder="Enter your Image"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                    <InputError :message="editForm.errors.image" />
                </div> 


                  </v-col> 

                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                      v-model="editForm.product_name"
                      label="Product name"
                     
                    ></v-text-field>
                    <InputError :message="editForm.errors.product_name"/>
                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="3"
                  >

                  <v-select
                    v-model="editForm.unit_type_id"
                    :items="unit_types"
                    item-title="unit_type"
                    item-value="id"
                    label="Unit type"
                    density="comfortable"
                  ></v-select>
                  <InputError :message="editForm.errors.unit_type_id"/>
                  </v-col> 

                   <v-col
                    cols="12"
                    sm="6"
                    md="3"
                  >
                    <v-text-field
                      v-model="editForm.unit"
                      label="Units"
                     
                    ></v-text-field>
                    <InputError :message="editForm.errors.unit"/>
                  </v-col>
               

                 <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editForm.stock_level"
                      label="Stock Level"
                    ></v-text-field>
                    <InputError :message="editForm.errors.stock_level"/>
                  </v-col>
               
                  <v-col
                    cols="12"
                    sm="6"
                    md="8"
                  >

                  <v-select
                    v-model="editForm.category_id"
                    :items="categories"
                    item-title="title"
                    item-value="id"
                    label="Category"
                    density="comfortable"
                  ></v-select>
                  <InputError :message="editForm.errors.category_id"/>
                  </v-col> 
                </v-row>
              </v-container>
              </form>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="$emit('closeDialog')"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="$emit('editSubmitForm',editForm)"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        
<!-- EDIT DIALOG -->
 </template>