<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';


defineProps(['products','categories']);
</script>

<script>

let form = useForm({
    file: null,
    product_name: '',
    price:'',
    quantity: '',
    category_id: '1',
});
export default {
    data: () => ({

      dialog: false,
      dialogDelete: false,
      search: '',
     
      editedIndex: -1,
   
    }),

    computed: {
   
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
    
      },


      deleteItem (item) {
        this.editedIndex = this.products.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

    
      close () {
        this.dialog = false
      
      
      },
      submitForm() {
      
      this.form.post(route('products.store'), { 
        onSuccess: () => this.form.reset() 
      })
      this.close()
    },

 
    },
  }
</script>
 <template>
    <v-dialog
          v-model="dialog"
          max-width="500px"
          persistent
        >
          <template v-slot:activator="{ props }">
            
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="props"
            >
              New Product
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">New Product</span>
            </v-card-title>

            <v-card-text>
              <form @submit.prevent="submitForm">
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
                        @input="form.file=$event.target.files[0]"
                        type="file"
                        name="file"
                        id="file"
                        required
                        placeholder="Enter your File"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                    <InputError :message="form.errors.file" class="mt-2" />
                </div> 


                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >
                    <v-text-field
                      v-model="form.product_name"
                      label="Product name"
                     
                    ></v-text-field>
                  </v-col>
                
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="form.price"
                      label="Price"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="form.quantity"
                      label="Quantity"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="12"
                  >

                  <v-select
                    v-model="form.category_id"
                    :items="categories"
                    item-text="title"
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
                @click="submitForm"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
 </template>