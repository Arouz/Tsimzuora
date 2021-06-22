// Case à solution unique // Célibataires nus
function CSU(Grille) {
    let NbP = 0;
    let LbN = 0;
    let CSU_ = false;
    for (let i = 0; i < Tp.length; i++) {
        for (let j = 0; j < 9; j++) {
            if (Tp[i][j] != 0) {
                NbP++;
                LbN = Tp[i][j];
            }
        }
        if (NbP == 1) {
            Grille[Tp[i][9]][Tp[i][10]] = LbN;
            Tp[i][LbN - 1] = 0;
            MaJAll(i, LbN-1);
            CSU_ = true;
        }
        NbP = 0;
        LbN = 0;
    }
    ReplaceT(Grille);
    return CSU_;
}