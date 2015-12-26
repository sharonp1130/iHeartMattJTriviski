package help.me;

import static org.junit.Assert.assertEquals;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.bo.impl.InfoBoImpl;
import help.me.orm.bo.impl.UserBoImpl;
import help.me.orm.dao.IServiceDao;
import help.me.orm.dao.impl.ServiceDaoImpl;
//import help.me.orm.entity.Service;
import help.me.orm.entity.User;

@Service("bunk")
public class Bunk {
	@Autowired
	ServiceDaoImpl sdao;

	@Autowired
	UserBoImpl ubo;
	
	@Autowired
	InfoBoImpl ibo;

	@Transactional
	public void balls() {
		User user = ubo.findByEmail("balls@gmail.com");
		
		if (user == null) {
			user = new User();
		}
		user.setEmail("balls@gmail.com");
		user.setFirstName("matt");
		user.setLastName("elias");
		user.setIsProvider(true);
		ubo.save(user);
		System.out.println(user);
	}
}
