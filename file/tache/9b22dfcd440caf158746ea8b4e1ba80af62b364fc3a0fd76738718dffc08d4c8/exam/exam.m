clear all
close all
clc
%---------1) transformation image en un image a niveau de gris---------

a = imread('hack.jpg');
image = rgb2gray(a);
figure
subplot(3,2,1);
imshow(a);
title('image principal');

subplot(3,2,2);
imhist(image);
title('histogramme');

%2)-------- appel etiremeent contraste-----------------
% j'ai mis max - 50 pour que vous voyez un peu la différence



I = exam2 (image);
subplot(3,2,3);
imshow(I);
title('etirement de contraste');

subplot(3,2,4);
imhist(I);
title('histogramme');




%3)--------------- appel egalisation d'histogramme -----------------

eghist = exam3 (image);

subplot(3,2,5);
imshow(eghist);
title('egalisation d histogramme');
subplot(3,2,6);
imhist(eghist);
title('histogramme');


%4 )--------------- comparaison des images apres egalisation d'histogramme
%et etiremeent contraste-------------------

% voir la ligne 2 et 3


%5 )--------------------- masquage de zone ----------------------
%voir figure 2 

masque = exam5 (image,2,13);

figure
subplot(2,2,1);
imshow(masque);
title('masquage de zone');

%6) -------------binarisation-------------- 
%voir figure 2
binary = exam6 (image,6);
subplot(2,2,2);
imshow(binary);
title('binarisation');



%7)-------------- bruit blanc gaussien de variance 0.5----------------

%voir figure 3
bruitgauss = imnoise(image,'gaussian', 0.5);
figure
subplot(3,3,1);
imshow(bruitgauss);
title('bruit blanc gaussien de variance 0.5');

%------------------bruit impulsionnel de variance 0.5-----------------

%voir figure 3

bruitimp = imnoise(image,'salt & pepper', 0.5);
subplot(3,3,2);
imshow(bruitimp);
title('bruit impulsionnel de variance 0.5');


%-----------------bruit multiplicatif de variance 0.5------------------

%voir figure 3

bruitmult = imnoise(image,'speckle', 0.5);
subplot(3,3,3);
imshow(bruitmult);
title('bruit multiplicatif de variance 0.5');

%8) -----------Filtre médian de l'image bruiter en blanc gaussien-------
%voir figure 4 
figure
subplot(3,3,1);
LMe = medfilt2(bruitgauss);
imshow(LMe);
title('Filtre médian de l image bruiter en blanc gaussien');

%-----------Filtre médian de l'image bruiter en impulsionnel---------
%voir figure 4 

subplot(3,3,2);
LMe1 = medfilt2(bruitimp);
imshow(LMe1);
title('Filtre médian de l image bruiter en impulsionnel');

%-----------Filtre médian de l'image bruiter en multiplicatif---------

%voir figure 4
subplot(3,3,3);
LMe2 = medfilt2(bruitmult);
imshow(LMe2);
title('Filtre médian de l image bruiter en multiplicatif');

%-----------Filtre  lissage fort de l'image bruiter en gaussian---
%voir figure 4 

lf = ones(3, 3) /9;
LF = conv2(bruitgauss, lf , 'same');
subplot(3,3,4);
imshow(uint8(LF));
title('Filtre  lissage fort de l image bruiter en gaussian');


%-----Filtre  lissage fort de l'image bruiter en impulsionnel----
%voir figure 4

lf = ones(3, 3) /9;
LF1 = conv2(bruitimp, lf , 'same');
subplot(3,3,5);
imshow(uint8(LF1));
title('Filtre  lissage fort de l image bruiter en impulsionnel');

%----Filtre  lissage fort de l'image bruiter en multiplicatif----
%voir figure 4

lf = ones(3, 3) /9;
LF2 = conv2(bruitmult, lf , 'same');
subplot(3,3,6);
imshow(uint8(LF2));
title('Filtre  lissage fort de l image bruiter en multiplicatif');


%-----Filtre  lissage moyen de l'image bruiter en gaussian------
%voir figure 4

lm = [1 2 1; 2 4 2; 1 2 1] /16;
LM = conv2(bruitgauss , lm , 'same');
subplot(3,3,7);
imshow(uint8(LM));
title('Filtre  lissage moyen de l image bruiter en gaussian');

%-----Filtre  lissage moyen de l'image bruiter en impulsionnel----
%voir figure 4

lm = [1 2 1; 2 4 2; 1 2 1] /16;
LM1 = conv2(bruitimp , lm , 'same');
subplot(3,3,8);
imshow(uint8(LM1));
title('Filtre  lissage moyen de l image bruiter en impulsionnel');


%------Filtre lissage moyen de l'image bruiter en multiplicatif-----
%voir figure 4 ligne

lm = [1 2 1; 2 4 2; 1 2 1] /16;
LM2 = conv2(bruitmult , lm , 'same');
subplot(3,3,9);
imshow(uint8(LM2));
title('Filtre passe lissage moyen de l image bruiter en multiplicatif');

%9)--------- filtre de type gradient ---------
%voir figure 5
R = a(:,:,1);
G = a(:,:,2);
B = a(:,:,3);

red = detectioncontours(R);
green = detectioncontours(G);
blue = detectioncontours(B);

resultat = cat(3, red,green,blue);

figure 
imshow(uint8(resultat));
title('filtre de type gradient');

