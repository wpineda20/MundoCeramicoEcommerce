import { Router } from "express"

import { getCategories, getProductsByCategories } from "../controllers/v1/categories.controller.js"
import { getProducts, getProductById, searchProduct } from "../controllers/v1/products.controller.js"

const router = Router();

router.get('/categories', getCategories);
router.get('/productsByCategory', getProductsByCategories);
router.get('/products', getProducts);
router.get('/products/search', searchProduct);
router.get('/products/:id', getProductById);

export default router;