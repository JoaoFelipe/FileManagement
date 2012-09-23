# coding: utf-8
import simplejson

f = open('docentes.json', 'r')
docentes = simplejson.load(f)
f.close()

docentes_servidores = {}

for i in range(1, 7):
    f = open('servidores-part%i.json' % (i), 'r')
    servidores = simplejson.load(f)
    f.close()
    for docente in docentes:
        try:
            docentes_servidores[docente] = servidores[docente.upper()]
            print "%s: %s" % (docente, docentes_servidores[docente])
        except KeyError:
            pass

for docente in docentes:
    if not docente in docentes_servidores:
        print "%s: %s" % (docente, "?")

f = open('docentes_servidores.json', 'w')
simplejson.dump(docentes_servidores, f, indent=4)
f.close()
