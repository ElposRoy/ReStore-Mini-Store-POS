<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

defineProps(['products','categories']);

</script>

<script>

let editForm = useForm({
    file: null,
    product_name: '',
    price:'',
    quantity: '',
    category_id: '',
});
export default {
    data: () => ({
    dialogEdit: false,
      search: '',
  
   
    }),


    watch: {
        dialogEdit (val) {
        val || this.close()
      },

    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
    
      },

      close () {
        this.editDialog = false
      
      },
      editSubmitForm() {
      this.editForm.post(route('products.update'), { 
        onSuccess: () => this.editForm.reset() 
      })
      this.close()
    },

 
    },
  }
</script>
 <template>
    <v-dialog
          v-model="dialogEdit"
          max-width="500px"
          persistent
        >
     
          <v-card>
            <v-card-title>
              <span class="text-h5">Edit Prodcut</span>
            </v-card-title>

            <v-card-text>
              <form @submit.prevent="editSubmitForm">
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >
                 <!-- <v-file-input
                    :value="form.file"

                    label="Product Image"
                    density="compact"
                  ></v-file-input> -->

                  <div class="mb-4">
                    <label for="file" class="block font-medium text-gray-700 mb-3">FILE</label>
                    <input
                        @input="editForm.file=$event.target.files[0]"
                        type="file"
                        name="file"
                        id="file"
                        required
                        placeholder="Enter your File"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                    <InputError :message="editForm.errors.file" class="mt-2" />
                </div> 


                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >
                    <v-text-field
                      v-model="editForm.product_name"
                      label="Product name"
                     
                    ></v-text-field>
                  </v-col>
                
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editForm.price"
                      label="Price"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editForm.quantity"
                      label="Quantity"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >

                  <v-select
                    v-model="editForm.category_id"
                    :items="categories"
                    item-title="title"
                    item-value="id"
                    label="Category"
                    density="comfortable"
                  ></v-select>
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
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="editSubmitForm"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
 </template>