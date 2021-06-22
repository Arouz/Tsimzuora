function grilleVerif(Grille) {
    for (i = 0; i < 9; i++)
        for (j = 0; j < 9; j++) {
            const x = Grille[i][j];
            if (x != 0) {
                for (ci = 0; ci < 9; ci++)
                    if (Grille[ci][j] == x && ci != i)
                        return false;

                for (lj = 0; lj < 9; lj++)
                    if (Grille[i][lj] == x && lj != j)
                        return false;

                wi = i - (i % 3);
                wj = j - (j % 3);
                for (gi = wi; gi < wi + 3; gi++)
                    for (gj = wj; gj < wj + 3; gj++)
                        if (Grille[gi][gj] == x && gi != i && gj != j)
                            return false;
            }
        }
    return true;
}

// Determine si la grille est terminé ou non 
function grilleTermine(Grille) {
    for (let i = 0; i < 9; i++)
        for (let j = 0; j < 9; j++)
            if (Grille[i][j] == 0)
                return false;
    return true;
}

// Vérification par ligne
function AbsLigne(i, Grille, k) {
    if (Grille[i].indexOf(k) != -1)
        return false;
    return true;
}

// Vérification par colonne
function AbsColonne(j, Grille, k) {
    for (i = 0; i < 9; i++)
        if (Grille[i][j] == k)
            return false;
    return true;
}
// Vérification par groupe
function AbsGroupe(i, j, Grille, x) {
    wi = i - (i % 3);
    wj = j - (j % 3);
    for (i = wi; i < wi + 3; i++)
        for (j = wj; j < wj + 3; j++)
            if (Grille[i][j] == x)
                return false;
    return true;
}


// Fonctions d'aléatoire 
function Aleatoire(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Créer le tableau à partir d'une grid
function Tableau(Grille) {
    const Dtableau = document.getElementById('Tableau');
    for (let i = 0; i < 9; i++) {
        Dtableau.innerHTML += "<tr id='TR" + i + "'>";
        const Dtr = document.getElementById('TR' + i);
        for (let j = 0; j < 9; j++) {
            let X = parseInt(i.toString() + j.toString()) - i;
            if (Grille[i][j] == 0)

                if (i == 2 || i == 5) {
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite bas'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                    else 
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille bas'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                } else {
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                    else
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                }

            else
                if (i==2 ||  i==5){
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite bas'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                    else
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille bas'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                } else {
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                    else
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                }
        }
        Dtableau.innerHTML += "</tr>";
    }
};

function SupprTableau(){
    const Dtableau = document.getElementById('Tableau');
    Dtableau.innerHTML = '';
}

function ReplaceT(Grille) {
    SupprTableau();
    Tableau(Grille);
}

const GridV = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0]
];

const GridF = [
    [0, 5, 0, 7, 2, 4, 3, 0, 0],
    [3, 7, 0, 0, 0, 1, 0, 2, 4],
    [9, 0, 2, 0, 0, 0, 5, 0, 0],
    [7, 0, 4, 2, 3, 6, 0, 8, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 3, 0, 9, 4, 7, 1, 0, 2],
    [0, 0, 3, 0, 0, 0, 6, 0, 8],
    [1, 9, 0, 6, 0, 0, 0, 4, 3],
    [0, 0, 7, 4, 5, 3, 0, 1, 0]
];

const GridM = [
    [0, 5, 7, 0, 9, 0, 0, 6, 4],
    [0, 0, 0, 3, 0, 0, 2, 9, 0],
    [1, 0, 9, 4, 6, 0, 7, 0, 5],
    [7, 0, 4, 2, 0, 0, 0, 0, 0],
    [0, 0, 0, 9, 0, 8, 0, 0, 0],
    [0, 0, 0, 0, 0, 4, 5, 0, 8],
    [8, 0, 1, 0, 4, 7, 6, 0, 9],
    [0, 4, 6, 0, 0, 9, 0, 0, 0],
    [9, 7, 0, 0, 8, 0, 1, 4, 0]
];

const GridD = [
    [4, 0, 0, 7, 0, 0, 5, 0, 0],
    [3, 0, 0, 8, 0, 0, 0, 0, 1],
    [7, 0, 0, 9, 0, 0, 0, 0, 8],
    [0, 6, 0, 0, 3, 0, 0, 1, 0],
    [0, 9, 0, 0, 7, 0, 0, 5, 0],
    [0, 8, 0, 0, 1, 0, 7, 9, 0],
    [0, 0, 2, 0, 0, 6, 9, 0, 0],
    [0, 0, 5, 0, 0, 0, 0, 3, 0],
    [0, 0, 0, 0, 0, 4, 2, 0, 0]
];

const GridTD = [
    [1, 0, 0, 5, 7, 0, 3, 0, 0],
    [0, 0, 0, 0, 0, 0, 5, 7, 0],
    [6, 0, 0, 0, 9, 0, 0, 0, 8],
    [0, 0, 0, 0, 0, 0, 0, 4, 1],
    [0, 0, 0, 6, 0, 3, 0, 0, 0],
    [7, 2, 8, 0, 0, 0, 0, 0, 0],
    [0, 9, 0, 2, 0, 6, 0, 0, 0],
    [0, 0, 0, 0, 0, 1, 2, 0, 3],
    [3, 5, 2, 0, 0, 0, 9, 0, 0]
];

const GridH = [
    [8, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 3, 6, 0, 0, 0, 0, 0],
    [0, 7, 0, 0, 9, 0, 2, 0, 0],
    [0, 5, 0, 0, 0, 7, 0, 0, 0],
    [0, 0, 0, 0, 4, 5, 7, 0, 0],
    [0, 0, 0, 1, 0, 0, 0, 3, 0],
    [0, 0, 1, 0, 0, 0, 0, 6, 8],
    [0, 0, 8, 5, 0, 0, 0, 1, 0],
    [0, 9, 0, 0, 0, 0, 4, 0, 0]
];

const GridoD = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 3, 0, 8, 5],
    [0, 0, 1, 0, 2, 0, 0, 0, 0],
    [0, 0, 0, 5, 0, 7, 0, 0, 0],
    [0, 0, 4, 0, 0, 0, 1, 0, 0],
    [0, 9, 0, 0, 0, 0, 0, 0, 0],
    [5, 0, 0, 0, 0, 0, 0, 7, 3],
    [0, 0, 2, 0, 1, 0, 0, 0, 0],
    [0, 0, 0, 0, 4, 0, 0, 0, 9]
];