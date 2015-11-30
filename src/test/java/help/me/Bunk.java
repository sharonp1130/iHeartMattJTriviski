package help.me;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.dao.IServiceDao;
//import help.me.orm.entity.Service;

@Service("bunk")
public class Bunk {
	@Autowired
	IServiceDao dao;
	
	@Transactional
	public void balls() {
		help.me.orm.entity.Service s = new help.me.orm.entity.Service();
		s.setDescription("Plubming");
		s.setServiceId(1234);
		dao.save(s);
	}
}
