import mongoose from 'mongoose';

try {
    const {
        DB_HOST,
        DB_NAME,
        DB_USER,
        DB_PASSWORD,
        DB_PORT
    } = process.env

    await mongoose.connect(`mongodb://${DB_USER}:${DB_PASSWORD}@${DB_HOST}:${DB_PORT}/${DB_NAME}?authSource=admin`)

    console.log('DB connected successfully.')
} catch (error) {
    // console.log(error)
    throw new Error(error)
}

export default mongoose;