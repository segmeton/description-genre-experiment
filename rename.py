import os

path = os.path.join(os.getcwd(), 'music')
# print(path)

for i in range(2, 11):
    curr_dir = os.path.join(path, str(i))
    # print(curr_dir)

    for root, dirs, files in os.walk(curr_dir):
        n = 1
        for filename in files:
            # print(filename)
            splits = filename.split('.')
            splits.append(splits[2])
            splits[2] = str(n)
            new_filename = '.'.join(splits)
            old_path = os.path.join(curr_dir, filename)
            new_path = os.path.join(curr_dir, new_filename)
            os.rename(old_path, new_path)
            # print(new_filename)
            # print(old_path)
            # print(new_path)
            if(n == 20):
                n = 1
            else:
                n = n + 1
    
