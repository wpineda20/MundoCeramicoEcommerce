import Product from "../../models/product.js";

export const getCategories = async (req, res) => {
    const search = req.params.search;
    const value = req.params.value;

    let categories = await Product.find({ ['categorias'.search]: value })
        .select('categorias')
        .distinct('categorias');

    // Deleting spaces and creating an array of products with no duplicates
    const categoriesFiltered = [];
    categories.forEach((product, index, self) => {
        if (!categoriesFiltered.some(p => p.name.trim() == product.name.trim())) {
            categoriesFiltered.push({
                id: product.id,
                name: product.name.trim()
            });
        }
    })

    return res.json(categoriesFiltered)
}

export const getProductsByCategories = async (req, res) => {
    const category = req.query.category;
    // console.log(req.query)

    let products = await Product.find({ ['categorias.name']: category });

    return res.json({
        message: '',
        total: products.length,
        data: products,
    })
}