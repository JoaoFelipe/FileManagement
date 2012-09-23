#include <stdio.h>
#include <stdlib.h>
#include <math.h>

/* Questao 1: Difusao */

double f(double x)
/* Funcao que da' a condicao inicial */
{
    return(exp(-((x-2.5)*(x-2.5)/0.04)));
}

double gx0(double t)
{
    return(0.0);
}
	
double gxfim(double t)
{
    return(0.0);
}

double f(double x);
double gx0(double t);
double gxfim(double t);
   
int main(void)
{	
    FILE *outf;
        
    double t, t0, tfim, x, x0, xfim, h, k, alfa, lambda;
    double **solucao;
    int i, j, nx, nt;

    outf = fopen("questao1.dat", "w");

    h = 0.00004; /* Discretizacao do tempo */
    k = 0.01;   /* Discretizacao do espaco */

    t0   = 0.0;
    tfim = 5.0;

    x0   = 0.0;
    xfim = 5.0;

    nt = (int) ((tfim - t0)/h) + 1;
    nx = (int) ((xfim - x0)/k) + 1;

    solucao = (double**) malloc (nt*sizeof(double*));
    for (i = 0; i < nt; i++)
    {
        solucao[i] = (double*) malloc (nx*sizeof(double));
    }
    
    fprintf(stdout, " Numero de intervalos temporais %d e espaciais %d", nt, nx);

    /* Parametros fisicos e variavel auxiliar */

    alfa = 1.0;

    lambda = alfa * h/(k * k);

    /* Condicao inicial */

    for (j = 0; j < nx; j++)
    {
        solucao[0][j] = f(x);
        x += k;
    }

    /* Condicao de contorno */

    t = t0;
    for (i = 0; i < nt-1; i++)
    {
        t += h;
        solucao[i][0]      = gx0(t);
        solucao[i][nx - 1] = gxfim(t);
        
        for (j = 1; j < nx - 1; j++)
        {
            solucao[i + 1][j] = lambda * (solucao[i][j + 1] + solucao[i][j - 1]) + 
                            (1.0 - 2.0 * lambda) * solucao[i][j];
        }
    }	   

    x = x0;

    for (j = 0; j < nx; j++)
    {
        fprintf(outf, "%e ", x);
        for (i = 0; i < nt; i++)
        {
            fprintf(outf, "%e ", solucao[i][j]);
        }
        fprintf(outf, "\n");
        x += k;
    }

    for (i = 0; i<nt; i++)
    {
        free(solucao[i]);
    }
    free(solucao);
}
