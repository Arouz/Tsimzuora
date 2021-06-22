/* 3.1.1 paire nue
Quand un groupe contient deux cases avec une même paire de candidats (et eux seuls) 
alors ces candidats ne peuvent se trouver dans une autre case du groupe. Cela fonctionne pour une ligne, une colonne ou un carré.  */
function Twin() {
    let StriLtwin = '';
    let ArrLigneTwin = [null, null, null, null, null, null, null, null, null];
    let StriCtwin = '';
    let ArrColonneTwin = [null, null, null, null, null, null, null, null, null];
    let StriGtwin = '';
    let ArrGroupeTwin = [null, null, null, null, null, null, null, null, null];

    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            for (let k = 0; k < 9; k++) {
                // L
                if (Tp[GrPs[i][j]][k] != 0) {
                    StriLtwin += k.toString();
                }
                // C
                if (Tp[GrPs[j][i]][k] != 0) {
                    StriCtwin += k.toString();
                }
                // G
                if (Tp[Grp[i][j]][k] != 0) {
                    StriGtwin += k.toString();
                }
            }
            // L
            if (StriLtwin.length == 2)
                ArrLigneTwin[j] = StriLtwin;
            // C
            if (StriCtwin.length == 2)
                ArrColonneTwin[j] = StriCtwin;
            // G
            if (StriGtwin.length == 2)
                ArrGroupeTwin[j] = StriGtwin;

            StriGtwin='';
            StriLtwin = '';
            StriCtwin = '';
        }
        //console.log(ArrLigneTwin);
        // L
        ComparaisonArray(ArrLigneTwin,1,i);
        // C
        ComparaisonArray(ArrColonneTwin,2,i);
        // G
        ComparaisonArray(ArrGroupeTwin,3,i);
    }
}

function ComparaisonArray(ArrayT,z,i){
    for (let l = 0; l < ArrayT.length; l++) {
        for (let m = (l + 1); m < ArrayT.length; m++) {
            if (ArrayT[l] == ArrayT[m] && ArrayT[l] != null) {
                let c1 = parseInt(ArrayT[l].toString().substring(0, 1));
                let c2 = parseInt(ArrayT[l].toString().substring(1, 2));
                switch (z) {
                    case 1:
                        MaJTLigne(i, l, m, c1, c2);
                        break;
                    case 2:
                        MaJTColonne(i, l, m, c1, c2);
                        break;
                    case 3:
                        MaJTGroupe(i, l, m, c1, c2);
                        break;
                    default:
                        break;
                }
            }
        }
    }
    for (let n = 0; n < ArrayT.length; n++) {
        ArrayT[n] = null;
    }
}