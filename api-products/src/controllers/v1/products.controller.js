import Product from "../../models/product.js"

export const getProducts = async (req, res) => {
    const search = req.query.search;
    const value = req.query.value;
    const page = req.query.page ?? 1;
    const limit = req.query.limit ?? 12;
    const skip = (page == 1) ? 0 : page * limit;

    const products = await Product.find({ [search]: value })
        .limit(limit)
        .skip(skip);

    const totalElements = await Product.count({});
    const pages = Math.floor(totalElements / limit);

    return res.json({
        pages,
        products,
    });
}

export const getProductById = async (req, res) => {
    const id = req.params.id;

    const product = await Product.findOne({ producto_id: id })

    return res.json(
        product
    )
}

export const searchProduct = async (req, res) => {
    const search = req.query.search;
    const page = req.query.page ?? 1;
    const limit = req.query.limit ?? 12;
    const skip = (page == 1) ? 0 : page * limit;

    const products = await Product.find(
        {
            $or: [
                { producto_id: { $regex: '.*' + search + '.*' } },
                { modelo: { $regex: '.*' + search + '.*' } },
                { titulo: { $regex: '.*' + search + '.*' } }
            ]
        })
        .limit(limit)
        .skip(skip);

    const totalElements = await Product.count(
        {
            $or: [
                { producto_id: { $regex: '.*' + search + '.*' } },
                { modelo: { $regex: '.*' + search + '.*' } },
                { titulo: { $regex: '.*' + search + '.*' } }
            ]
        }
    );

    const pages = Math.floor(totalElements / limit);

    return res.json({
        pages,
        products,
    });
}