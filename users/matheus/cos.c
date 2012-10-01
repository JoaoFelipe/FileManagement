#include <stdio.h>
#include <math.h>
#define N 20

int main() {

  int i;
  FILE *f = fopen("exe5.dat", "w");

  fprintf(f, "n = %d;\nperiod = [ ", N);
  for(i=1 ; i <= N ; i++, fprintf(f, "%s", (i <= N) ? ", " : " ];"))
    fprintf(f, "%f", 10*i + exp(i) - cos(2*i));

  fclose(f);
  return 0;
}
