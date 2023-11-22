import mongoose, { Schema } from "mongoose";

const Product = new Schema({
    name: String,
    producto_id: {
        type: String
    },
    modelo: {
        type: String
    },
    total_existencia: {
        type: Number
    },
    titulo: {
        type: String
    },
    marca: {
        type: String
    },
    img_portada: {
        type: String
    },
    categorias: {
        type: [
            Object
        ]
    },
    marca_logo: {
        type: String
    },
    link: {
        type: String
    },
    peso: {
        type: String
    },
    peso_volumetrico: {
        type: String
    },
    unidad_de_medida: {
        codigo_unidad: {
            type: String
        },
        nombre: {
            type: String
        }
    },
    alto: {
        type: String
    },
    largo: {
        type: String
    },
    ancho: {
        type: String
    },
    peso_unidad: {
        type: String
    },
    dimensiones_unidad: {
        type: String
    },
    precios: {
        final_price: {
            type: Number
        },
        list_price: {
            type: String
        }
    }
});

export default mongoose.model('Product', Product);