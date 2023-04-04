<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

defineEmits(['closeDialog','categorySubmitForm'])

defineProps(['categories','dialogCategory']);

let categoryForm = useForm({
   title: "",
});

</script>
  <!-- CATEGORY DIALOG -->
 <template>
     <v-dialog
  v-model="dialogCategory"
  max-width="500px"
  persistent
>
  <v-card>
    <v-card-title>
      <span class="text-h5">Add Category</span>
    </v-card-title>

    <v-card-text>
      <form @submit.prevent="submitProducts">
      <v-container>
        <v-row>
          <v-col
            cols="12"
            sm="6"
            md="12"
          >
            <v-text-field
              v-model="categoryForm.title"
              label="New Category Title"
              
            ></v-text-field>
            <InputError :message="categoryForm.errors.title" />
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
        @click="$emit('categorySubmitForm',categoryForm)"
      >
        Save
      </v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
 </template>
<!-- CAATEGORY DIALOG -->