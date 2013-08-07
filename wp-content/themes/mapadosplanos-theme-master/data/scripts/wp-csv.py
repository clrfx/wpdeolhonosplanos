import os

import csvkit

# Muda para o diretorio data
#os.chdir("..")

# Carrega o csv do munc2011
f_read = open("wp_munic2011.csv", "r")

# Prepara lista de posts
f_write = open("wp_munic2011_posts.csv", "w")
reader = csvkit.CSVKitDictReader(f_read)
posts = []
for line in reader:
	f_post = line
	f_post["id"] = ''
	f_post["post_title"] = f_post["wpcf-a570"] + " - " + f_post["wpcf-a569"]
	f_post["post_type"] = "municipio"
	f_post["post_status"] = "publish"
	f_post["comment_status"] = "open"
	f_post["post_author"] = f_post["ibge"]
	f_post["lat"] = f_post["lat"].replace(",",".")
	f_post["lng"] = f_post["lng"].replace(",",".")
	posts.append(f_post)

writer = csvkit.CSVKitDictWriter(f_write, posts[0].keys())
writer.writeheader()
writer.writerows(posts)
f_write.close()

# Prepara lista de usuarios
f_write = open("wp_munic2011_users.csv", "w")

authors = []
for line in posts:
	f_author = {}
	f_author["user_login"] = line["ibge"]
	f_author["user_pass"] = line["ibge"]
	f_author["user_email"] = line["ibge"] + "@mapadosplanos.org.br"
	f_author["first_name"] = line["wpcf-a570"]
	f_author["last_name"] = line["wpcf-a569"]
	f_author["display_name"] = line["wpcf-a570"] + " - " + line["wpcf-a569"]
	f_author["role"] = "author"
	f_author["ibge"] = line["ibge"]
	authors.append(f_author)

writer = csvkit.CSVKitDictWriter(f_write, authors[0].keys())
writer.writeheader()
writer.writerows(authors)
f_write.close()

f_read.close()
