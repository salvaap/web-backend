<template>
<div>
    <v-btn color="secondary" tile small @click.prevent="init"><v-icon left small>mdi-image</v-icon>Seleccionar imágenes</v-btn>
    <v-dialog v-model="gallery_modal" persistent scrollable>
        <v-card>
            <v-card-title><h3>Galería de Imágenes de Producto</h3><v-spacer></v-spacer><v-btn icon @click.prevent="close"><v-icon>mdi-close</v-icon></v-btn></v-card-title>
            <v-card-text style="height: 80vh;">
                <v-row>
                    <v-col cols="12">
                        <v-progress-linear v-if="uploading" :value="progress"></v-progress-linear>
                        <v-file-input dense filled chips multiple @change="images_change" accept="image/png, image/jpeg, image/jpg" placeholder="Subir imágenes" prepend-icon="mdi-image" label="Subir imagenes" hint="Las imagenes deben tener dimensiones mínimas de 800px y máximas de 1000px; debe ser una imagen cuadrada" persistent-hint :error-messages="upload_error"></v-file-input>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col v-if="loading" cols="12">
                        <div class="text-center">
                            <v-progress-circular :size="50" color="primary" indeterminate></v-progress-circular>
                        </div>
                    </v-col>
                    <v-col v-else cols="12">
                        <v-item-group multiple v-model="selected_items" v-if="items.length">
                            <v-row>
                                <v-col v-for="item in items" :key="item.id" cols="6" sm="3" lg="2" xl="1">
                                    <v-item v-slot="{active, toggle}" :value="item.url">
                                        <v-card outlined tile>
                                            <v-img class="text-right pa-1 b-1" :src="item.url" :lazy-src="'/images/placeholder.jpg'" aspect-ratio="1" @click="toggle">
                                                <template v-slot:placeholder>
                                                    <v-row class="fill-height ma-0" align="center" justify="center"><v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular></v-row>
                                                </template>
                                                <v-btn icon dark>
                                                    <v-icon color="blue">{{ active ? 'mdi-checkbox-marked' : 'mdi-checkbox-blank-outline' }}</v-icon>
                                                </v-btn>
                                            </v-img>
                                        </v-card>
                                    </v-item>
                                </v-col>
                            </v-row>
                        </v-item-group>
                        <div v-else>
                            <p class="text-center">No hay imágenes en la galería de productos.</p>
                        </div>
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn tile small color="primary" type="button" :disabled="uploading || (selected_items.length < 1)" @click.prevent="select">Seleccionar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>
</template>
<script>
import ProductService from '../../services/products';
export default {
    props: ['index'],
    data() {
        return {
            gallery_modal: false,
            loading: true,
            uploading: false,
            upload_error: '',
            items: [],
            selected_items: [],
            progress: 0,
            ps: new ProductService(),
        };
    },
    mounted() {
    },
    methods: {
        init() {
            this.gallery_modal = true;
            this.getImages();
        },
        close() {
            this.selected_items = [];
            this.gallery_modal = false;
        },
        select() {
            if(this.index !== undefined) {
                this.$emit('selected', this.selected_items, this.index);
            } else {
                this.$emit('selected', this.selected_items);
            }
            this.selected_items = [];
            this.gallery_modal = false;
        },
        images_change(files) {
            if(files.length < 1) {
                return;
            }
            var formdata = new FormData();
            _.forEach(files, (image) => {
                formdata.append('images[]', image);
            });
            this.uploading = true;
            this.upload_error = '';
            this.ps.uploadImages(formdata, {headers: {'Content-Type': 'multipart/form-data'}, onUploadProgress: this.upload_progress})
                .then(data => {
                    this.items = _.unionBy(data.images, this.items, 'id');
                })
                .catch(e => {
                    this.upload_error = (e.errors.image) ? e.errors.image[0] : 'Una o más imagenes no tienen las dimensiones correctas: mínimo de 800px, máximo de 1000px (imagen cuadrada)';
                    //console.log(e);
                })
                .finally(() => {
                    this.uploading = false;
                });
        },
        upload_progress(e) {
            this.progress = (e.loaded * 100) / e.total;
        },
        getImages() {
            this.ps.getImages()
                .then(data => {
                    this.items = data.items;
                }).catch(e => {
                    //console.log(e)
                }).finally(() => {
                    this.loading = false;
                });
        }
    }
}
</script>