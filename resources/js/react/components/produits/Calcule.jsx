// CalculUtils.js
export const calculateValues = (product, isTvaActive, isRemiseActive) => {
    const qte = parseFloat(product.qte) || 0;
    const tva = parseFloat(product.tva) || 0;
    const prixVente = parseFloat(product.prixVente) || 0;
    const remise = parseFloat(product.remise) || 0;

    const pht = isTvaActive ? prixVente / (1 + tva) : prixVente;
    const pttc = prixVente;
    let total = pttc * qte;

    if (isRemiseActive) {
        total *= (1 - remise / 100);
    }

    return {
        pht: pht.toFixed(2),
        pttc: pttc.toFixed(2),
        total: total.toFixed(2),
    };
};

export const calculateTotals = (listeproducts, isTvaActive, isRemiseActive) => {
    const totals = listeproducts.reduce(
        (acc, product) => {
            const { pht, total } = calculateValues(product, isTvaActive, isRemiseActive);
            const qteNum = parseFloat(product.qte) || 0;
            const tva = parseFloat(product.tva) || 0;

            acc.totalHT += parseFloat(pht) * qteNum;
            acc.totalTTC += parseFloat(total);

            if (isTvaActive) {
                const tvaAmount = (tva * qteNum) ;
                acc.totalTVA += tvaAmount;
            }

            return acc;
        },
        { totalHT: 0, totalTVA: 0, totalTTC: 0 }
    );

    return {
        totalHT: totals.totalHT.toFixed(2),
        totalTVA: totals.totalTVA.toFixed(2),
        totalTTC: totals.totalTTC.toFixed(2),
    };
};
