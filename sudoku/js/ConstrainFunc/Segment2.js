// Quand dans une ligne/colonne un seul carré peut contenir un chiffre, ce chiffre peut être exclu des autres cases de ce carré.
function CheckSegment2() {
    let SLp1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SLp2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SLp3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    let SCp1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SCp2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SCp3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    let nboccL = [0, 0],
        nboccC = [0, 0];

    for (let l = 0; l < 9; l++) {
        // Eventail des possibles : ligne / carré
        for (let k = 0; k < 3; k++) {
            for (let i = 0; i < 9; i++) {
                if (Tp[GrPs[l][k]][i] != 0) SLp1[i] = Tp[GrPs[l][k]][i];
                if (Tp[GrPs[l][k + 3]][i] != 0) SLp2[i] = Tp[GrPs[l][k + 3]][i];
                if (Tp[GrPs[l][k + 6]][i] != 0) SLp3[i] = Tp[GrPs[l][k + 6]][i];
            }
        }

        // Eventail des possibles : Segment de colonne
        for (let k = 0; k < 3; k++) {
            for (let i = 0; i < 9; i++) {
                if (Tp[GrPs[k][l]][i] != 0) SCp1[i] = Tp[GrPs[k][l]][i];
                if (Tp[GrPs[k + 3][l]][i] != 0) SCp2[i] = Tp[GrPs[k + 3][l]][i];
                if (Tp[GrPs[k + 6][l]][i] != 0) SCp3[i] = Tp[GrPs[k + 6][l]][i];
            }
        }

        /*      
        console.log('----------------------------------------------');
        console.log('L' + (l+1) + ' = ' + SLp1 + ' ' + SLp2 + ' ' + SLp3);
        console.log('C' + (l+1) + ' = ' + SCp1 + ' ' + SCp2 + ' ' + SCp3);
        console.log('----------------------------------------------'); 
        */

        for (k = 0; k < 9; k++) {
            // Chaque segment ligne
            if (SLp1.indexOf(k+1) >= 0) {
                nboccL[0]++;
                nboccL[1] = 0;
            }
            if (SLp2.indexOf(k+1) >= 0) {
                nboccL[0]++;
                nboccL[1] = 1;
            }
            if (SLp3.indexOf(k+1) >= 0) {
                nboccL[0]++;
                nboccL[1] = 2;
            }

            if (nboccL[0] == 1) {
                //console.log((k + 1) + " n'est possible que dans ... L" + (l+1) +  ', Segment : ' + (nboccL[1]))
                // Boucle pour retirer les propositions inutiles
                for (let i = 0; i < 9; i++) {
                    // Si ligne = 0
                    if (l == 0)
                        // Alors retirer que les 6 derniers chiffre du groupe
                        if (i > 2)
                            Tp[Grp[nboccL[1]][i]][k] = 0;
                    if (l == 1)
                        if (i < 3 && i > 5)
                            Tp[Grp[nboccL[1]][i]][k] = 0;
                    if (l == 2)
                        if (i < 6)
                            Tp[Grp[nboccL[1]][i]][k] = 0;

                    if (l == 3)
                        if (i > 2)
                            Tp[Grp[nboccL[1] + 3][i]][k] = 0;
                    if (l == 4)
                        if (i < 3 && i > 5)
                            Tp[Grp[nboccL[1] + 3][i]][k] = 0;
                    if (l == 5)
                        if (i < 6)
                            Tp[Grp[nboccL[1] + 3][i]][k] = 0;

                    if (l == 6)
                        if (i > 2)
                            Tp[Grp[nboccL[1] + 6][i]][k] = 0;
                    if (l == 7)
                        if (i < 3 && i > 5)
                            Tp[Grp[nboccL[1] + 6][i]][k] = 0;
                    if (l == 8)
                        if (i < 6)
                            Tp[Grp[nboccL[1] + 6][i]][k] = 0;
                }
            }
            nboccL[0] = 0;


            if (SCp1.indexOf(k+1) >= 0) {
                nboccC[0]++;
                nboccC[1] = 0;
            }
            if (SCp2.indexOf(k+1) >= 0) {
                nboccC[0]++;
                nboccC[1] = 3;
            }
            if (SCp3.indexOf(k+1) >= 0) {
                nboccC[0]++;
                nboccC[1] = 6;
            }

            if (nboccC[0] == 1) {
                //console.log((k + 1) + " n'est possible que dans ... C" + (l+1) +  ', Segment : ' + nboccC[1])
                for (let i = 0; i < 9; i++) {
                    if (l == 0)
                        if (i != 0 && i != 3 && i != 6)
                            Tp[Grp[nboccC[1]][i]][k] = 0;
                    if (l == 1)
                        if (i != 1 && i != 4 && i != 7)
                            Tp[Grp[nboccC[1]][i]][k] = 0;
                    if (l == 2)
                        if (i != 2 && i != 5 && i != 8)
                            Tp[Grp[nboccC[1]][i]][k] = 0;

                    if (l == 3)
                        if (i != 0 && i != 3 && i != 6)
                            Tp[Grp[nboccC[1] + 1][i]][k] = 0;
                    if (l == 4)
                        if (i != 1 && i != 4 && i != 7)
                            Tp[Grp[nboccC[1] + 1][i]][k] = 0;
                    if (l == 5)
                        if (i != 2 && i != 5 && i != 8)
                            Tp[Grp[nboccC[1] + 1][i]][k] = 0;

                    if (l == 6)
                        if (i != 0 && i != 3 && i != 6)
                            Tp[Grp[nboccC[1] + 2][i]][k] = 0;
                    if (l == 7)
                        if (i != 1 && i != 4 && i != 7)
                            Tp[Grp[nboccC[1] + 2][i]][k] = 0;
                    if (l == 8)
                        if (i != 2 && i != 5 && i != 8)
                            Tp[Grp[nboccC[1] + 2][i]][k] = 0;
                }
            }
            nboccC[0] = 0; 
        }
        for (let g = 0; g < 9; g++) {
            SLp1[g] = 0;
            SLp2[g] = 0;
            SLp3[g] = 0;
            SCp1[g] = 0;
            SCp2[g] = 0;
            SCp3[g] = 0;
        }
    }
}