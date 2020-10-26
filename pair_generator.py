import numpy

data = numpy.array([
(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
(2, 3, 4, 5, 6, 7, 8, 9, 10, 1),
(3, 4, 5, 6, 7, 8, 9, 10, 1, 2),
(4, 5, 6, 7, 8, 9, 10, 1, 2, 3),
(5, 6, 7, 8, 9, 10, 1, 2, 3, 4),
(6, 7, 8, 9, 10, 1, 2, 3, 4, 5),
(7, 8, 9, 10, 1, 2, 3, 4, 5, 6),
(8, 9, 10, 1, 2, 3, 4, 5, 6, 7),
(9, 10, 1, 2, 3, 4, 5, 6, 7, 8),
(10, 1, 2, 3, 4, 5, 6, 7, 8, 9),
(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
(2, 3, 4, 5, 6, 7, 8, 9, 10, 1),
(3, 4, 5, 6, 7, 8, 9, 10, 1, 2),
(4, 5, 6, 7, 8, 9, 10, 1, 2, 3),
(5, 6, 7, 8, 9, 10, 1, 2, 3, 4),
(6, 7, 8, 9, 10, 1, 2, 3, 4, 5),
(7, 8, 9, 10, 1, 2, 3, 4, 5, 6),
(8, 9, 10, 1, 2, 3, 4, 5, 6, 7),
(9, 10, 1, 2, 3, 4, 5, 6, 7, 8),
(10, 1, 2, 3, 4, 5, 6, 7, 8, 9),])

print(data.shape)

template = []
for i in range(0, data.shape[1]):

    pair_list = []
    for j in range(0, data.shape[0]):
        genre = data[j, i]
        # genre i+10 -> 2nd song of genre i
        if (j+1 > 10):
            genre = genre + 10
        pair = 'array('+str(j+1)+','+str(genre)+')'
        pair_list.append(pair)
        # print(str(j+1)+','+str(data[j, i]))

    group_final = ', '.join(pair_list)
    template.append('array('+group_final+')')


final = ', '.join(template)

print(final)

f = open("generated_pair.txt", "w")
f.write(final)
f.close()