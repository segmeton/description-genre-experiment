import os
import csv
import time
import re
import operator

data_path = 'raw_data'
data_list = []

# generate empty array for image question data
# n is number of images
n = 20
question_data = [ [ 0 for child_arr in range(5) ] for parent_arr in range(n) ] 
# generate empty array for image favorite data
fav_data = []

for root, dirs, files in os.walk(data_path):
    
    for filename in files:

        # create dictionary for data that will be put to csv
        data_dict = {}

        # 1.BU.1603804561.txt
        splits = filename.split('.')
        # print(splits[0])

        data_dict["group"] = splits[0]
        data_dict["session"] = splits[1]
        data_dict["timestamp"] = splits[2]

        path = os.path.join(root, filename)

        # for english
        f = open(path, "r", encoding="utf8")

        reader = csv.reader(f)
        next(reader)
        
        for row in reader:
            string = str(row)
            content = string[2:len(string)-2]
            match_question_img = re.search(r"question-(\d*)-(\w*) : (.*)", content)
            # print(content)
            if match_question_img:
                # put all image question data into question_data to be processed later
                qid = int(match_question_img.group(1))
                q_key = match_question_img.group(2)
                q_value = match_question_img.group(3)
                question_data[qid-1][0] = qid
                if(q_key == 'image'):
                    match_img = re.search(r'\w*.(\d*).\w*', q_value)
                    question_data[qid-1][1] = int(match_img.group(1))
                elif(q_key == 'music'):
                    match_music = re.search(r"\d*/((\w*).(\S*))", content)
                    question_data[qid-1][3] = match_music.group(2)
                    question_data[qid-1][4] = match_music.group(1)
                elif(q_key == 'description'):
                    question_data[qid-1][2] = q_value
            else:
                # put all favorite question data into fav_data to be processed later
                match2 = re.search(r"(\w*)-fav-music\S* : (.*)", content)
                # print(content)
                # print(match2)
                if(len(match2.group()) > 2):
                    fav_data.append(match2.group(2))

        # print(question_data)
        # get genre for this question
        most_fav_genre = question_data[int(fav_data[0])-1]
        least_fav_genre = question_data[int(fav_data[2])-1]

        # sorting the data based on the image id
        question_data = sorted(question_data, key=operator.itemgetter(1))

        # put img data to dictionary
        for data in question_data:
            data_dict["image-"+str(data[1])+"-qid"] = data[0]
            data_dict["image-"+str(data[1])+"-desc"] = data[2]
            data_dict["image-"+str(data[1])+"-music-genre"] = data[3]
            data_dict["image-"+str(data[1])+"-music"] = data[4]

        # put fav data to dictionary
        data_dict["most-fav-music-genre"] = most_fav_genre[3]
        data_dict["most-fav-music"] = most_fav_genre[4]
        data_dict["most-fav-music-reason"] = fav_data[1]
        data_dict["least-fav-music-genre"] = least_fav_genre[3]
        data_dict["least-fav-music"] = least_fav_genre[4]
        data_dict["least-fav-music-reason"] = fav_data[3]

        f.close()

        data_list.append(data_dict)

# print(data_list)
# getting timestamp
ts = time.time()

csv_name =  '.'.join(["data/data", str(ts), "csv"])

# writing csv
with open(csv_name, 'w', newline='') as csvfile:
    fieldnames = ['group', 'session', 'timestamp']

    for i in range(n):
        fieldnames.extend(["image-"+str(i+1)+"-qid", "image-"+str(i+1)+"-desc", "image-"+str(i+1)+"-music-genre", "image-"+str(i+1)+"-music"])

    fieldnames.extend(["most-fav-music-genre", "most-fav-music", "most-fav-music-reason", "least-fav-music-genre",  "least-fav-music", "least-fav-music-reason"])
    
    writer = csv.DictWriter(csvfile, fieldnames=fieldnames)

    writer.writeheader()
    writer.writerows(data_list)

# sample data
# user-id : 1
# question-1-image : mid_00834949_001.20.jpg
# question-1-music : 10/reggae.00070.14.wav
# question-1-description : Test
# question-2-image : mid_00513096_001.7.jpg
# question-2-music : 7/rock.00002.2.wav
# question-2-description : Test
# question-3-image : mid_00759711_001.19.jpg
# question-3-music : 9/metal.00000.1.wav
# question-3-description : Test
# question-4-image : mid_00418887_001.5.jpg
# question-4-music : 5/jazz.00079.19.wav
# question-4-description : Zjsbdjndkznz
# question-5-image : mid_00602826_001.15.jpg
# question-5-music : 5/jazz.00011.4.wav
# question-5-description : Test
# question-6-image : mid_00546692_001.12.jpg
# question-6-music : 2/classical.00083.18.wav
# question-6-description : Etsd
# question-7-image : mid_00759298_001.18.jpg
# question-7-music : 8/disco.00065.14.wav
# question-7-description : Sjsnsn
# question-8-image : mid_00601788_001.14.jpg
# question-8-music : 4/hiphop.00031.5.wav
# question-8-description : Nzjzjzmz
# question-9-image : mid_00423991_001.6.jpg
# question-9-music : 6/pop.00092.19.wav
# question-9-description : Znzjkzlzm
# question-10-image : mid_00523667_001.9.jpg
# question-10-music : 9/metal.00032.7.wav
# question-10-description : Znznzkzmz
# question-11-image : mid_00327154_001.3.jpg
# question-11-music : 3/country.00062.13.wav
# question-11-description : Xkznzmzsm
# question-12-image : mid_00527032_001.10.jpg
# question-12-music : 10/reggae.00084.17.wav
# question-12-description : Zkzkzk
# question-13-image : mid_00418829_001.4.jpg
# question-13-music : 4/hiphop.00020.4.wav
# question-13-description : Hzhsjdndkzjxm
# question-14-image : mid_00513107_001.8.jpg
# question-14-music : 8/disco.00098.20.wav
# question-14-description : Zjznzkkzmz
# question-15-image : mid_00588993_001.13.jpg
# question-15-music : 3/country.00000.1.wav
# question-15-description : Zkzkzksjdn
# question-16-image : mid_00611816_001.16.jpg
# question-16-music : 6/pop.00086.18.wav
# question-16-description : Znjsbdjzks
# question-17-image : mid_00219992_001.2.jpg
# question-17-music : 2/classical.00013.3.wav
# question-17-description : Zmzkskdbdb
# question-18-image : mid_00530983_001.11.jpg
# question-18-music : 1/blues.00080.16.wav
# question-18-description : Zjnsbehznznz
# question-19-image : mid_00691974_001.17.jpg
# question-19-music : 7/rock.00076.14.wav
# question-19-description : Nzjsbdbzjz
# question-20-image : AN1613004271_l.1.jpg
# question-20-music : 1/blues.00007.2.wav
# question-20-description : Zhdnskzkznzn
# most-fav-music : 16
# most-fav-music-reason : Xhdjsnsn
# least-fav-music : 20
# least-fav-music-reason : Xndundjznsjs
