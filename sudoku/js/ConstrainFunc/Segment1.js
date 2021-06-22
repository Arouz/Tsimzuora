// Quand dans un carré, un chiffre n'est possible que sur un segment, alors le candidat peut être exclu de cette colonne/ligne dans les autres carrés.
function CheckSegment1() {
    let nboccrL = [0, 0],
        nboccrC = [0, 0];
    // Les 3 segments ligne d'une case
    let pSL1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSL2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSL3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];
    // Les 3 segments colonne d'une case
    let pSC1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSC2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSC3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    for (let l = 0; l < 9; l++) {
        // Eventail des possibles : Segment de ligne
        for (let k = 0; k < 3; k++) {
            for (let i = 0; i < 9; i++) {
                if (Tp[Grp[l][k]][i] != 0) pSL1[i] = Tp[Grp[l][k]][i];
                if (Tp[Grp[l][k + 3]][i] != 0) pSL2[i] = Tp[Grp[l][k + 3]][i];
                if (Tp[Grp[l][k + 6]][i] != 0) pSL3[i] = Tp[Grp[l][k + 6]][i];
            }
        }

        // Eventail des possibles : Segment de colonne
        for (let k = 0; k < 9; k += 3) {
            for (let i = 0; i < 9; i++) {
                if (Tp[Grp[l][k]][i] != 0) pSC1[i] = Tp[Grp[l][k]][i];
                if (Tp[Grp[l][k + 1]][i] != 0) pSC2[i] = Tp[Grp[l][k + 1]][i];
                if (Tp[Grp[l][k + 2]][i] != 0) pSC3[i] = Tp[Grp[l][k + 2]][i];
            }
        }
        
        //console.log('Groupe : ' + (l + 1));
        //console.log('L = ' + pSL1 + ' ' + pSL2 + ' ' + pSL3);
        //console.log('C = ' + pSC1 + ' ' + pSC2 + ' ' + pSC3); 

        // Comparer chacun des segments par categories entre eux
        for (let k = 0; k < 9; k++) {
            if (pSL1.indexOf(k+1) >= 0) {
                nboccrL[0]++;
                nboccrL[1] = 0;
            }
            if (pSL2.indexOf(k+1) >= 0) {
                nboccrL[0]++;
                nboccrL[1] = 1;
            }
            if (pSL3.indexOf(k+1) >= 0) {
                nboccrL[0]++;
                nboccrL[1] = 2;
            }

            if (nboccrL[0] == 1) {
                // retire k+1 des choix pour le reste de la ligne
                // Si la ligne concernée fait parti des groupe compris entre 1 et 3 
                    for (let i = 0; i < 9; i++) {
                        // Si il s'agit du groupe 1 alors modifier que la parti des groupes 2 et 3 de la ligne
                        if (l == 0)
                            if (i > 2)
                                Tp[GrPs[(nboccrL[1])][i]][k] = 0;
                        // Si il s'agit du groupe 2 alors modifier que la parti des groupes 1 et 3 de la ligne
                        if (l == 1)
                            if (i < 3 && i > 5)
                                Tp[GrPs[(nboccrL[1])][i]][k] = 0;
                        // Si il s'agit du groupe 3 alors modifier que la parti des groupes 1 et 2 de la ligne
                        if (l == 2)
                            if (i < 6)
                                Tp[GrPs[(nboccrL[1])][i]][k] = 0;
                    // Si la ligne concernée fait parti des groupe compris entre 4 et 6 
                        if (l == 3)
                            if (i > 2)
                                Tp[GrPs[(nboccrL[1] + 3)][i]][k] = 0;
                        if (l == 4)
                            if (i < 3 && i > 5)
                                Tp[GrPs[(nboccrL[1] + 3)][i]][k] = 0;
                        if (l == 5)
                            if (i < 6)
                                Tp[GrPs[(nboccrL[1] + 3)][i]][k] = 0;
                    // Si la ligne concernée fait parti des groupe compris entre 7 et 9 
                        if (l == 6)
                            if (i > 2)
                                Tp[GrPs[(nboccrL[1] + 6)][i]][k] = 0;
                        if (l == 7)
                            if (i < 3 && i > 5)
                                Tp[GrPs[(nboccrL[1] + 6)][i]][k] = 0;
                        if (l == 8)
                            if (i < 6)
                                Tp[GrPs[(nboccrL[1] + 6)][i]][k] = 0;
                    }
                //console.log((k + 1) + " n'est possible que dans ... L" + nboccrL[1])
            }
            nboccrL[0] = 0;

            if (pSC1.indexOf(k+1) >= 0) {
                nboccrC[0]++;
                nboccrC[1] = 0;
            }
            if (pSC2.indexOf(k+1) >= 0) {
                nboccrC[0]++;
                nboccrC[1] = 1;
            }
            if (pSC3.indexOf(k+1) >= 0) {
                nboccrC[0]++;
                nboccrC[1] = 2;
            }
            if (nboccrC[0] == 1) {
                // retire k+1 des choix pour le reste de la Colonne
                //console.log((k + 1) + " n'est possible que dans ... C" + nboccrC[1])
                    for (let i = 0; i < 9; i++) {
                        // Si il s'agit du groupe 1 alors modifier que la parti des groupes 3 et 6 de la colonne
                        if (l == 0)
                            if (i > 2)
                                Tp[GrPs[i][(nboccrC[1])]][k] = 0;
                        // Si il s'agit du groupe 3 alors modifier que la parti des groupes 1 et 6 de la colonne
                        if (l == 3)
                            if (i < 3 && i > 5)
                                Tp[GrPs[i][(nboccrC[1])]][k] = 0;
                        // Si il s'agit du groupe 6 alors modifier que la parti des groupes 1 et 3 de la colonne
                        if (l == 6)
                            if (i < 6)
                                Tp[GrPs[i][(nboccrC[1])]][k] = 0;
                    
                        if (l == 1)
                            if (i > 2)
                                Tp[GrPs[i][(nboccrC[1] + 3)]][k] = 0;
                        if (l == 4)
                            if (i < 3 && i > 5)
                                Tp[GrPs[i][(nboccrC[1] + 3)]][k] = 0;
                        if (l == 7)
                            if (i < 6)
                                Tp[GrPs[i][(nboccrC[1] + 3)]][k] = 0;
                    
                        if (l == 2)
                            if (i > 2)
                                Tp[GrPs[i][(nboccrC[1] + 6)]][k] = 0;
                        if (l == 5)
                            if (i < 3 && i > 5)
                                Tp[GrPs[i][(nboccrC[1] + 6)]][k] = 0;
                        if (l == 8)
                            if (i < 6)
                                Tp[GrPs[i][(nboccrC[1] + 6)]][k] = 0;
                    }
            }
            nboccrC[0] = 0;
        }
        for (let g = 0; g < 9; g++) {
            pSC1[g] = 0;
            pSC2[g] = 0;
            pSC3[g] = 0;
            pSL1[g] = 0;
            pSL2[g] = 0;
            pSL3[g] = 0;
        }
    }
}