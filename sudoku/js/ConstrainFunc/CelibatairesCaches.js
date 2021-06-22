// Célibataires cachés
function CbtC(Grille) {
    let CbtC_ = false;
    let SimG = [0,0,0];

    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            for (let k = 0; k < 9; k++) {
                if (Tp[Grp[i][k]][j] != 0){
                    SimG[0] += 1;
                    SimG[1] = (j+1);
                    SimG[2] = Grp[i][k];
                }
                if (SimG[0] > 1) {
                    break;
                }
            }
            if (SimG[0] == 1) {
                Grille[Math.trunc(SimG[2] / 9)][SimG[2] % 9] = SimG[1];
                MaJAll(SimG[2], (SimG[1]-1));
                CbtC_ = true;
            }
            for (let l = 0; l < 3 ; l++){
                SimG[l]=0;
            }
        }
    }
    ReplaceT(Grille);
    return CbtC_;
}