const GridAleatoire = [
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

function mainFunc() {
    supprGrid(GridV);
    createGBTK(0, GridV);
    ReplaceT(GridV);
    nbbt = 0;
}

function Seek() {

    let L1 = "", 
        L2 = "", 
        L3 = "",
        L4 = "", 
        L5 = "", 
        L6 = "", 
        L7 = "", 
        L8 = "",
        L9 = "";

    do {
        RechercheGrille()
    } while (!RechercheGrille())

    for (let i = 0; i < 9; i++) {
        L1 += GridAleatoire[0][i];
        L2 += GridAleatoire[1][i];
        L3 += GridAleatoire[2][i];
        L4 += GridAleatoire[3][i];
        L5 += GridAleatoire[4][i];
        L6 += GridAleatoire[5][i];
        L7 += GridAleatoire[6][i];
        L8 += GridAleatoire[7][i];
        L9 += GridAleatoire[8][i];
    }

    ReplaceT(GridAleatoire);

    let ajaxurl = 'https://www.tsimzuora.com/lib/ajax.php';
    let datax = {'action': 'insert', 'L1': L1, 'L2': L2, 'L3': L3, 'L4': L4, 'L5': L5, 'L6': L6, 'L7': L7, 'L8': L8, 'L9': L9};

    $.post(ajaxurl, datax, function (data) {
        if (data == "yes") {
            $(".SudokuComplete").text("La grille a bien été enregistrée.");
            $(".SudokuComplete").slideDown(500).delay(2500).slideUp(900);
        } else {
            $(".SudokuError").text("La grille n'a pas pu être enregistrée.");
            $(".SudokuError").slideDown(500).delay(2500).slideUp(900);
        }
    });

}

function RechercheGrille() {
    // RàZ la grille de depart
    supprGrid(GridV);
    // Créer une grille
    createGBTK(0, GridV);
    // Randomize la grille
    RandGrid(GridV, 65);
    // Creer une copie qui sera utilisée si la grille est valide
    for (let i = 0; i < 9; i++)
        for (let j = 0; j < 9; j++)
            GridAleatoire[i][j] = GridV[i][j];
    // Vérifie la validité de la grille
    if (ResoudreCSTNFC(GridV))
        return true;
    else 
        return false;
}

function ResoudreCSTNFC(Grille) {
    // Créer la liste des possible pour chaque case
    PxC(0, Grille);
    // Boucle tant que des cases sont solutionées
    do {
        // Traque les nakeds twins et MAJ la liste des possibles
        Twin();
        CbtC(Grille);
        CSU(Grille);
    } while (CSU(Grille) || CbtC(Grille))
    // Vérifie si la grille est terminé ou non et determine la validité de celle ci 
    if (grilleTermine(Grille))
        return Grille;
    else 
        return false;
}

function gridJouable() {
    RandGrid(GridV, 65);
    for (let i = 0; i < 9; i++)
        for (let j = 0; j < 9; j++)
            GridAleatoire[i][j] = GridV[i][j];
    ReplaceT(GridV);
}

function UniqueSolution() {
    ResoudreCSTN(GridV);
    if (grilleTermine(GridV))
        console.log(GridAleatoire);
}


function razPxC() {
    for (let i = 0; i < 81; i++)
        for (let j = 0; j < 9; j++)
            Tp[i][j] = 0;
}


// Met à 0 x% de la grille
function RandGrid(Grille,Force) {
    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            let w = Aleatoire(1, 100);
            if (w <= Force) {
                Grille[i][j] = 0;
            }
        }
    }
    razPxC();
}


// Remet la grille à 0
function supprGrid(Grille) {
    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            Grille[i][j] = 0;
        }
    }
}

// Compteur de nombte d'appel de la fonction
let nbbt = 0;
function createGBTK(Position, Grille) {
    nbbt++;
    if (Position == 81)
        return true;
    const i = Math.trunc(Position / 9);
    const j = Position % 9;
    // Si la grille selectionnée n'est pas égal à 0 (déjà remplie) alors on passe à la suivante
    if (Grille[i][j] != 0)
        return createGBTK(Position + 1, Grille);
    // Test chaque nombre possible pour la position donnée
    for (let k = 1; k <= 18; k++) {
        let w = Aleatoire(1, 9);
        if (AbsLigne(i, Grille, w) && AbsColonne(j, Grille, w) && AbsGroupe(i, j, Grille, w)) {
            Grille[i][j] = w;
            if (createGBTK(Position + 1, Grille)) {
                return true;
            }
        }
    }
    Grille[i][j] = 0;
    return false;

}