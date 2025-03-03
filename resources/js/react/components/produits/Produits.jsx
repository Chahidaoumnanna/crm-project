//
// import React, { useState } from 'react';
// import AjouterProduits from "./AjouterProduit.jsx";
// import ListeProduits from "./ListeProduits.jsx";
// import ModifierProduit from "./ModifierProduit.jsx";
//
// const Produits = () => {
//     const [editingProduct, setEditingProduct] = useState(null);
//
//     const handleEdit = (product) => {
//         setEditingProduct(product);
//     };
//
//     const handleCloseEdit = () => {
//         setEditingProduct(null);
//     };
//
//     return (
//         <div className='shadow-sm p-4 rounded bg-white'>
//             <h5 className='text-muted mb-4 border-bottom pd-2'>Produits : </h5>
//             {editingProduct ? (
//                 <ModifierProduit
//                     editingProduct={editingProduct}
//                     onSubmitSuccess={handleCloseEdit}
//                 />
//             ) : (
//                 <AjouterProduits handleEdit={handleEdit} />
//             )}
//             <ListeProduits handleEdit={handleEdit} />
//         </div>
//     );
// };
//
// export default Produits;



import React, { useState } from 'react';
import AjouterProduits from "./AjouterProduit.jsx";
import ListeProduits from "./ListeProduits.jsx";
import ModifierProduit from "./ModifierProduit.jsx";

const Produits = () => {
    const [editingProduct, setEditingProduct] = useState(null);

    const handleEdit = (product) => {
        setEditingProduct(product);
    };

    const handleCloseEdit = () => {
        setEditingProduct(null);
    };

    return (
        <div>
            {editingProduct ? (
                <ModifierProduit
                    editingProduct={editingProduct}
                    onSubmitSuccess={handleCloseEdit}
                />
            ) : (
                <AjouterProduits handleEdit={handleEdit} />
            )}
            <ListeProduits handleEdit={handleEdit} />
        </div>
    );
};

export default Produits;
